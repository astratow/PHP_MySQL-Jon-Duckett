<?php
class ImageHandlerException extends Exception {};

class ImageHandler
{
    public    $fileTypes  = ['image/jpeg', 'image/png',];        // Allowed types
    protected $filepath   = '';                                  // Path to file
    protected $filename   = '';                                  // Name of file
    protected $imageData  = [];                                  // Image data
    protected $origWidth  = 0;                                   // Image width
    protected $origHeight = 0;                                   // Image height
    protected $mediaType  = '';                                  // Media type

    public function __construct(string $filepath, string $filename) 
    {
        $this->filepath   = $filepath;                           // Path to file upload
        $this->filename   = $filename;                           // Name of uploaded file
        $this->imageData  = getimagesize($filepath);             // Get image data
        $this->origWidth  = $this->imageData[0];                 // Image width
        $this->origHeight = $this->imageData[1];                 // Image height
        $this->mediaType  = $this->imageData['mime'];            // Media type

        if (!in_array($this->mediaType, $this->fileTypes)) {     // If media type not allowed
            throw new ImageHandlerException('File not an accepted image format', 1);
        }
    }

    public function resizeImage(int $newWidth, int $newHeight, string $uploadPath): string
    {
        if (($this->origWidth < $newWidth)         
        or ($this->origHeight < $newHeight)) {                   // If original is too small
            throw new ImageHandlerException('Original image too small', 2);
        }

        $orig_ratio = $this->origWidth / $this->origHeight;            // Ratio of original
        $new_ratio  = $newWidth / $newHeight;                          // Ratio of crop

        // Calculate new size
        if ($new_ratio < $orig_ratio) {                                // If new ratio < orig
            $select_width  = $this->origHeight * $new_ratio;           // Calculate width
            $select_height = $this->origHeight;                        // Height stays same
            $x_offset      = ($this->origWidth - $select_width) / 2;   // Calculate X Offset
            $y_offset      = 0;                                        // Y offset = 0 (top)
        } else {                                                       // Otherwise
            $select_width  = $this->origWidth;                         // Width stays same
            $select_height = $this->origWidth * $new_ratio;            // Calculate height
            $x_offset      = 0;                                        // X-offset = 0 (left)
            $y_offset      = ($this->origHeight - $select_height) / 2; // Calculate Y Offset
        }

        switch($this->mediaType) {                                      // If media type is
            case 'image/jpeg' :                                         // JPEG
                $orig = imagecreatefromjpeg($this->filepath);           // Open JPEG
                break;                                                  // End of switch
            case 'image/png' :                                          // PNG
                $orig = imagecreatefrompng($this->filepath);            // Open PNG
                break;                                                  // End of switch
        }

        $new = imagecreatetruecolor($newWidth, $newHeight);             // New blank image
        imagecopyresampled($new, $orig, 0, 0, $x_offset, $y_offset, $newWidth, 
                           $newHeight, $select_width, $select_height);  // Crop and resize

        $path = $this->createFilepath($this->filename, $uploadPath);    // Create filepath

        // Save the image in the correct format
        switch($this->mediaType) {
            case 'image/gif' : $result = imagegif($new, $path);  break;  // Save GIF 
            case 'image/jpeg': $result = imagejpeg($new, $path); break;  // Save JPEG
            case 'image/png' : $result = imagepng($new, $path);  break;  // Save PNG
        }
        return $path;
    }

    public function createFilepath($filename, $uploadPath): string
    {
        $basename  = pathinfo($filename, PATHINFO_FILENAME);             // Get filename
        $extension = pathinfo($filename, PATHINFO_EXTENSION);            // Get extension
        $basename  = preg_replace("/[^A-z0-9]/", "-", $basename);        // Clean filename
        $filepath  = $uploadPath . $basename . '.' . $extension;         // Destination
        $i         = 0;                                                  // Counter
        while (file_exists($filepath)) {                                 // If file exists
            $i        = $i + 1;                                          // Update counter
            $filepath = $uploadPath . $basename . $i . '.' . $extension; // New filepath
        }
        return $filepath;                                                // Return filepath
    }

    // Other methods could perform other tasks with the image
}