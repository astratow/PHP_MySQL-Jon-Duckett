<?php
// Part A: Setup
declare(strict_types=1);                                 // Use strict types
include '../../src/bootstrap.php';                       // Include setup file

// Initialize variables that the PHP code needs
$id          = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Get id+validate
$temp        = $_FILES['image']['tmp_name'] ?? '';       // Temporary image
$destination = '';                                       // Where to save file
$saved       = null;                                     // Did article save

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
];                                                       // Errors

if ($id) {                                               // If valid id
    $article = $cms->getArticle()->get($id, false);      // Get article data
    if (!$article) {                                     // If article empty
        redirect('admin/articles.php', ['failure' => 'Article not found']); // Redirect
    }
}

$saved_image = $article['image_file'] ? true : false;    // Has an image been uploaded
$authors    = $cms->getMember()->getAll();               // Get all members
$categories = $cms->getCategory()->getAll();             // Get categories


// Part B: Get and validate form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form submitted
    // If file bigger than limit in php.ini or .htaccess store error message
    $errors['image_file'] = ($_FILES['image']['error'] === 1) ? 'File too big ' : '';

    // If image was uploaded, get image data and validate
    if ($temp and $_FILES['image']['error'] == 0) {      // Check file
        $article['image_alt'] = $_POST['image_alt'];                   // Get alt text

        // Validate image file
        $errors['image_file'] = in_array(mime_content_type($temp), MEDIA_TYPES)
            ? '' : 'Wrong file type. ';                                // Check file type
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)); // File extension in lowercase
        $errors['image_file'] .= in_array($extension, FILE_EXTENSIONS)
            ? '' : 'Wrong file extension. ';                           // Check file extension
        $errors['image_file'] .= ($_FILES['image']['size'] <= MAX_SIZE)
            ? '' : 'File too big. ';                                   // Check size
        $errors['image_alt']  = (Validate::isText($article['image_alt'], 1, 254))
            ? '' : 'Alt text must be 1-254 characters.';               // Check alt text

        // If image file is valid, specify the location to save it
        if ($errors['image_file'] === '' and $errors['image_alt'] === '') { // If valid
            $article['image_file'] = create_filename($_FILES['image']['name'], UPLOADS);
            $destination = UPLOADS . $article['image_file'];          // Destination
        }
    }

    // Get article data
    $article['title']       = $_POST['title'];              // Title
    $article['summary']     = $_POST['summary'];            // Summary
    $article['content']     = $_POST['content'];            // Content
    $article['member_id']   = $_POST['member_id'];          // Author
    $article['category_id'] = $_POST['category_id'];        // Category
    $article['published']   = (isset($_POST['published']) and ($_POST['published'] == 1)) ? 1 : 0;   // Is it published?

    // Validate article data and create error messages if it is invalid
    $errors['title']    = Validate::isText($article['title'], 1, 80)
        ? '' : 'Title must be 1-80 characters';
    $errors['summary']  = Validate::isText($article['summary'], 1, 254)
        ? '' : 'Summary must be 1-254 characters';
    $errors['content']  = Validate::isText($article['content'], 1, 100000)
        ? '' : 'Article must be 1-100,000 characters';
    $errors['member']   = Validate::isMemberId($article['member_id'], $authors)
        ? '' : 'Please select an author';
    $errors['category'] = Validate::isCategoryId($article['category_id'], $categories)
        ? '' : 'Please select a category';

    $invalid = implode($errors);                                 // Join errors

    // Part C: Check if data is valid, if so update database
    if ($invalid) {                                                     // If invalid data
        $errors['warning'] = 'Please correct form errors';              // Store error
    } else {                                                            // Otherwise
        $arguments = $article;                                          // Save data as $params
        if ($id) {                                                      // If id exists update
            $saved = $cms->getArticle()->update($arguments, $temp, $destination); // Update article
        } else {                                                        // No id create
            unset($arguments['id']);                                    // Remove id from arguments
            $saved = $cms->getArticle()->create($arguments, $temp, $destination); // Create article
        }

        if ($saved == true) {                                           // If updated
            redirect('admin/articles.php', ['success' => 'Article saved']); // Redirect
        } else {                                                        // Otherwise
            $errors['warning'] = 'Article title already in use';        // Store message
        }
    }
    $article['image_file'] = $saved_image ? $article['image_file'] : ''; // Remove image if new article
}
?>
<?php include APP_ROOT . '/public/includes/admin-header.php'; ?>
  <form action="article.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
    <main class="container admin" id="content">

      <h1>Edit Article</h1>
      <?php if ($errors['warning']) { ?>
        <div class="alert alert-danger"><?= $errors['warning'] ?></div>
      <?php } ?>

      <div class="admin-article">
        <section class="image">
          <?php if (!$article['image_file']) { ?>
            <label for="image">Upload image:</label>
            <div class="form-group image-placeholder">
              <input type="file" name="image" class="form-control-file" id="image"><br>
              <span class="errors"><?= $errors['image_file'] ?></span>
            </div>
            <div class="form-group">
              <label for="image_alt">Alt text: </label>
              <input type="text" name="image_alt" id="image_alt" value="" class="form-control">
              <span class="errors"><?= $errors['image_alt'] ?></span>
            </div>
          <?php } else { ?>
            <label>Image:</label>
            <img src="../uploads/<?= html_escape($article['image_file']) ?>"
                 alt="<?= html_escape($article['image_alt']) ?>">
            <p class="alt"><strong>Alt text:</strong> <?= html_escape($article['image_alt']) ?></p>
            <a href="alt-text-edit.php?id=<?= $article['id'] ?>" class="btn btn-secondary">Edit alt text</a>
            <a href="image-delete.php?id=<?= $id ?>" class="btn btn-secondary">Delete image</a><br><br>
          <?php } ?>
        </section>

        <section class="text">
          <div class="form-group">
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" value="<?= html_escape($article['title']) ?>"
                   class="form-control">
            <span class="errors"><?= $errors['title'] ?></span>
          </div>
          <div class="form-group">
            <label for="summary">Summary: </label>
            <textarea name="summary" id="summary"
                      class="form-control"><?= html_escape($article['summary']) ?></textarea>
            <span class="errors"><?= $errors['summary'] ?></span>
          </div>
          <div class="form-group">
            <label for="content">Content: </label>
            <textarea name="content" id="content"
                      class="form-control"><?= html_escape($article['content']) ?></textarea>
            <span class="errors"><?= $errors['content'] ?></span>
          </div>
          <div class="form-group">
            <label for="member_id">Author: </label>
            <select name="member_id" id="member_id">
              <?php foreach ($authors as $author) { ?>
                <option value="<?= $author['id'] ?>"
                    <?= ($article['member_id'] == $author['id']) ? 'selected' : ''; ?>>
                    <?= html_escape($author['forename'] . ' ' . $author['surname']) ?></option>
              <?php } ?>
            </select>
            <span class="errors"><?= $errors['author'] ?></span>
          </div>
          <div class="form-group">
            <label for="category">Category: </label>
            <select name="category_id" id="category">
              <?php foreach ($categories as $category) { ?>
                <option value="<?= $category['id'] ?>"
                    <?= ($article['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                    <?= html_escape($category['name']) ?></option>
              <?php } ?>
            </select>
            <span class="errors"><?= $errors['category'] ?></span>
          </div>
          <div class="form-check">
            <input type="checkbox" name="published" value="1" class="form-check-input" id="published"
                <?= ($article['published'] == 1) ? 'checked' : ''; ?>>
            <label for="published" class="form-check-label">Published</label>
          </div>
          <input type="submit" name="update" value="Save" class="btn btn-primary">
        </section><!-- /.text -->
      </div><!-- /.admin-article -->
    </main>
  </form>
<?php include APP_ROOT . '/public/includes/admin-footer.php'; ?>