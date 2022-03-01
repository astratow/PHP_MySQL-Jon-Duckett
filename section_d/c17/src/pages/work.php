<?php
declare(strict_types = 1);                               // Use strict types
use PhpBook\Validate\Validate;                           // Use Validate class

$article = [];                                           // Article data
$errors  = [];                                           // Error messages
$temp        = $_FILES['image']['tmp_name'] ?? '';       // Temporary image
$destination = '';                                       // Where to save file
$saved       = null;                                     // Did article save

if ($id) {                                               // If id - edit existing work
    $article = $cms->getArticle()->get($id);             // Get article data
    if (!$article) {                                     // If article is empty
        include APP_ROOT . '/public/page-not-found.php'; // Page not found
    }
    if ($article['member_id'] !== $cms->getSession()->id) { // If not author of article
        include APP_ROOT . '/public/page-not-found.php'; // Page not found
    }
}

$saved_image = $article['image_file'] ?? false;          // Has an image been uploaded
$categories  = $cms->getCategory()->getAll();            // Get categories

if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // Form submitted
    // If file bigger than limit in php.ini or .htaccess store error message
    $errors['image_file'] = ($_FILES['image']['error'] === 1) ? 'File too big ' : '';

    // If image was uploaded, get image data and validate
    if ($temp and $_FILES['image']['error'] == 0) {      // Check file
        $errors['image_file']  = in_array(mime_content_type($temp), MEDIA_TYPES)
            ? '' : 'Wrong file type. ';                                   // File type
        $errors['image_file'] .= ($_FILES['image']['size'] <= MAX_SIZE)
            ? '' : 'File too big. ';                                      // File size

        $article['image_alt'] = $_POST['image_alt'];                      // Get alt text
        $errors['image_alt']  = Validate::isText($article['image_alt'], 1, 254)
            ? '' : 'Alt text can be 1-1000 characters.';                  // Alt text

        if ($errors['image_file'] == '' and $errors['image_alt'] == '') { // If valid
            $article['image_file'] = create_filename($_FILES['image']['name'], 'uploads/'); // Filename
            $destination = UPLOADS . $article['image_file'];
        }
    }

    $article['title']       = $_POST['title'];           // Get title
    $article['summary']     = $_POST['summary'];         // Get summary
    $article['content']     = $_POST['content'];         // Get content
    $article['member_id']   = $_POST['member_id'];       // Get member_id
    $article['category_id'] = $_POST['category_id'];     // Get category_id
    $article['published']   = 1;                         // Set published
    $article['seo_title']   = create_seo_name($article['title']);   // Create SEO version of title (introduced in Chapter 17 - needed in Chapter 16)

    $purifier = new HTMLPurifier();                                                    // Create HTMLPurifier
    $purifier->config->set('HTML.Allowed', 'p,br,strong,em,b,i,a[href],img[src|alt]'); // Permitted tags
    $article['content'] = $purifier->purify($article['content']);                      // Purify content

    $errors['title']    = (Validate::isText($article['title'], 1, 80))
        ? '' : 'Title should be 1 - 80 characters.';                      // Validate title
    $errors['summary']  = (Validate::isText($article['summary'], 1, 254))
        ? '' : 'Summary should be 1 - 254 characters.';                   // Validate summary
    $errors['content']  = (Validate::isText($article['content'], 1, 100000))
        ? '' : 'Content should be 1 - 100,000 characters.';               // Validate content
    $errors['category'] = Validate::isCategoryId($article['category_id'], $categories)
        ? '' : 'Not a valid category';                                    // Validate category

    $temp = $_FILES['image']['tmp_name'] ?? '';                           // Temporary image


    if ($id == false and $temp == '') {                                   // If new article with no temp image path
        $errors['image_file'] = 'Please upload an image';                 // Add error message to upload an image
    }

    $invalid = implode($errors);                                          // Join error messages

    if ($invalid) {                                                       // If invalid data
        $errors['message'] = 'Please correct form errors';                // Store message
    } else {                                                              // Otherwise
        if ($id) {                                                        // If id exists: update
            $saved = $cms->getArticle()->update($article, $temp, $destination); // Update article
        } else {                                                          // No id: create
            $saved = $cms->getArticle()->create($article, $temp, $destination); // Create article
        }
        if ($saved === true) {                                            // If updated
            redirect('member/' . $cms->getSession()->id);                 // Send to member page
        } else {
            $errors['message'] = 'Article title already in use';          // Store message
        }
    }
    $article['image_file'] = $saved_image ? $article['image_file'] : '';  // Remove image if new article
}

$data['navigation'] = $categories;                                  // Navigation
$data['categories'] = $categories;                                  // Categories for drop down
$data['article']    = $article;                                     // Article
$data['errors']     = $errors;                                      // Errors

echo $twig->render('work.html', $data);                             // Render template