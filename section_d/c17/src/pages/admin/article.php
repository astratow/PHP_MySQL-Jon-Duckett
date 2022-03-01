<?php
// Part A: Setup
use PhpBook\Validate\Validate;                           // Import Validate namespace
is_admin($session->role);                                // Check if admin

// Initialize variables that the PHP code needs
$temp        = $_FILES['image']['tmp_name'] ?? '';       // Temporary image
$destination = '';                                     // Where to save file
$saved       = null;                                     // Did article save

// Initialize variables needed for the HTML page
// Initialize variables needed for the HTML page
$article = [
    'id'          => $id,
    'title'       => '',
    'summary'     => '',
    'content'     => '',
    'member_id'   => 0,
    'category_id' => 0,
    'image_id'    => null,
    'published'   => false,
    'image_file'  => '',
    'image_alt'   => '',
];                                                       // Article data
$errors  = [
    'warning'     => '',
    'title'       => '',
    'summary'     => '',
    'content'     => '',
    'author'      => '',
    'category'    => '',
    'image_file'  => '',
    'image_alt'   => '',
];

if ($id) {                                               // If valid id
    $article = $cms->getArticle()->get($id, false);      // Get article data
    if (!$article) {                                     // If article empty
        redirect('admin/articles/', ['failure' => 'Article not found']); // Redirect
    }
}

$saved_image = $article['image_file'] ? true : false;    // Has an image been uploaded
$authors     = $cms->getMember()->getAll();              // Get all members
$categories  = $cms->getCategory()->getAll();            // Get categories

// Part B: Get and validate form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form submitted
    // If file bigger than limit in php.ini or .htaccess store error message
    $errors['image_file'] = ($_FILES['image']['error'] === 1) ? 'File too big ' : '';

    // If image was uploaded, get image data and validate
    if ($temp and $_FILES['image']['error'] == 0) {      // Check file
        $article['image_alt']  = $_POST['image_alt'];                    // Get alt text

        // Validate image data
        $errors['image_file']  = in_array(mime_content_type($temp), MEDIA_TYPES)
            ? '' : 'Wrong file type. ';                                  // Validate file type
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)); // File extension in lowercase
        $errors['image_file'] .= in_array($extension, FILE_EXTENSIONS)
            ? '' : 'Wrong file extension. ';                             // Validate file extension
        $errors['image_file'] .= ($_FILES['image']['size'] <= MAX_SIZE)
            ? '' : 'File too big. ';                                     // Validate file size
        $errors['image_alt']   = Validate::isText($article['image_alt'], 1, 254)
            ? '' : 'Alt text can be 1-1000 characters.';                 // Alt text

        if ($errors['image_file'] === '' and $errors['image_alt'] === '') {     // If valid
            $article['image_file'] = create_filename($_FILES['image']['name'], UPLOADS); // Path
            $destination = UPLOADS . $article['image_file'];             // Destination
        }
    }

    $article['title']       = $_POST['title'];           // Get title
    $article['summary']     = $_POST['summary'];         // Get summary
    $article['content']     = $_POST['content'];         // Get content
    $article['member_id']   = $_POST['member_id'];       // Get member_id
    $article['category_id'] = $_POST['category_id'];     // Get category_id
    $article['published']   = (isset($_POST['published'])) ? 1 : 0; // Get navigation
    $article['seo_title']   = create_seo_name($article['title']);   // SEO friendly title

    $purifier               = new HTMLPurifier();                     // Create Purifier
    $purifier->config->set('HTML.Allowed', 'p,br,b,i,a[href],img[src|alt]'); // Allowed
    $article['content']     = $purifier->purify($article['content']); // Purify content

    // Check if all data was valid and create error messages if it is invalid
    $errors['title']    = Validate::isText($article['title'], 1, 80)
        ? '' : 'Title should be 1 - 80 characters.';     // Validate title
    $errors['summary']  = Validate::isText($article['summary'], 1, 254)
        ? '' : 'Summary should be 1 - 254 characters.';  // Validate summary
    $errors['content']  = Validate::isText($article['content'], 1, 100000)
        ? '' : 'Content should be 1 - 100,000 characters.'; // Validate content
    $errors['member']   = Validate::isMemberId($article['member_id'], $authors)
        ? '' : 'Not a valid author';                     // Validate author
    $errors['category'] = Validate::isCategoryId($article['category_id'], $categories)
        ? '' : 'Not a valid category';                   // Validate category

    $invalid = implode($errors);

    // Part C: Check if data is valid, if so update database
    if ($invalid) {                                                     // If invalid data
        $errors['warning'] = 'Please correct form errors';              // Store error
    } else {                                                            // Otherwise
        $arguments = $article;                                          // Save data as $arguments
        if ($id) {                                                      // If id exists update
            $saved = $cms->getArticle()->update($arguments, $temp, $destination); // Update article
        } else {                                                        // No id create
            unset($arguments['id']);
            $saved = $cms->getArticle()->create($arguments, $temp, $destination); // Create article
        }

        if ($saved == true) {                                            // If updated
            redirect('admin/articles/', ['success' => 'Article saved']); // Redirect
        } else {                                                         // Otherwise
            $errors['warning'] = 'Article title already in use';         // Store message
        }
    }
    $article['image_file'] = $saved_image ? $article['image_file'] : ''; // Remove image if new article
}

$data['article']    = $article;                          // Article data for template
$data['categories'] = $categories;                       // Category data for template
$data['authors']    = $authors;                          // Author data data for template
$data['errors']     = $errors;                           // Error data for template

echo $twig->render('admin/article.html', $data);         // Render Twig template