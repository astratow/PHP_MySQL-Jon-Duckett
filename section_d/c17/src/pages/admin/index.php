<?php
is_admin($session->role);                                // Check if admin
$data['article_count']  = $cms->getArticle()->count();   // Get number of articles
$data['category_count'] = $cms->getCategory()->count();  // Get number of categories
$data['member_count']   = $cms->getMember()->count();    // Get number of categories

echo $twig->render('admin/index.html', $data);           // Render Twig template