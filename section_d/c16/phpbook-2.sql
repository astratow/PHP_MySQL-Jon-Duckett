--
-- Database: `phpbook-2`
-- This is the second database used in the PHP & MySQL book
-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `seo_title` varchar(244) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `summary`, `content`, `created`, `category_id`, `member_id`, `image_id`, `published`, `seo_title`) VALUES
(1, 'Systemic Brochure', 'Brochure design for science festival', '<p>This brochure design is part of a suite of advertising materials that promote the Systemic science festival. These materials feature the complex visual identity that is an abstract grid of pathways representing choice and decision-making in designing complex systems.</p>', '2021-01-26 12:21:03', 1, 2, 1, 1, 'systemic-brochure'),
(2, 'Forecast', 'Illustration for fashion magazine article', '<p>This drawing was commissioned by a fashion magazine for an article about spotting future trends. This piece uses luxury handbags to mimic clouds in a kind of fashion-based weather forecast-style graphic. The use of repetition and pattern highlights the potential power of a single prediction.</p>', '2021-01-28 19:44:03', 3, 2, 19, 1, 'forecast'),
(3, 'Swimming pool', 'Architecture magazine photography', '<p>This photograph is one of a series commissioned for an article in an architectural magazine featuring swimming pools in private residences. The variety of locations shared a similar mid-century modern aesthetic and were rendered using a grainy, black and white film stock.</p>', '2021-02-02 09:45:52', 4, 1, 3, 1, 'swimming-pool'),
(4, 'Walking Birds', 'Artwork for music video', '<p>The brief for this music video was to combine a psychedelic sixties vibe with a granola-brown seventies aesthetic and morph it into a Sesame Street-style animation. With over two million views online, the artwork successfully promoted the song across multiple social media channels.</p>', '2021-02-12 11:05:35', 3, 3, 4, 1, 'walking-birds'),
(5, 'Sisters', 'Editorial graphics for psychology article', '<p>The article that these illustrations accompany highlights the changing landscape of family connections in the modern age as compared to fifty years ago. The brief was to visualize the interpersonal drift caused by increased dispersement of communities across the globe.</p>', '2021-02-26 15:31:16', 3, 3, 5, 1, 'sisters'),
(6, 'Micro-Dunes', 'Photography for scientific journal', '<p>This photograph was commissioned to accompany a scientific article about micro-ecologies in the coastal environment. Due to the miniature scale of the subject matter, a macro lens was used to capture the fine detail. It was shot on location on the mid-north coast of Australia.</p>', '2021-03-02 21:02:47', 4, 1, 6, 1, 'micro-dunes'),
(7, 'Milk Beach Website', 'Website for music series', '<p>Using the imagery commissioned for the album artwork, this website aims to provide a simple channel for users to listen to the music digitally. Care was taken to ensure fans of the music could connect with the brand and keep updated on future offerings.</p>', '2021-03-06 10:16:22', 2, 1, 7, 1, 'milk-beach-website'),
(8, 'Wellness App', 'App for health facility', '<p>The Wellness chain of health facilities required an app that allowed members to view and book classes. The existing brand style guide defined the overall look and feel of the site with the main goal of the design to be as minimalistic as possible.</p>', '2021-03-12 14:45:49', 2, 2, 8, 1, 'wellness-app'),
(9, 'Milk Beach Music', 'Photography for a music series', '<p>The music label that released this series wanted to capture the beach that inspired its creation. A number of photographs (including panoramic views and close-ups) were shot on location at Milk Beach in Sydney, Australia. They were given a duotone appearance in post-production.</p>', '2021-03-12 17:09:40', 4, 1, 9, 1, 'milk-beach-music'),
(10, 'Polite Society Mural', 'Large-scale illustrations for fashion label', '<p>This is one of several illustrations commissioned by fashion label, Polite Society, to decorate their new autumn-winter collection displays. Appearing in various forms (such as murals, digital projections, and in print) they represent the modern aesthetic of the latest range.</p>', '2021-03-16 14:14:40', 3, 1, 10, 1, 'polite-society-mural'),
(11, 'Stargazer Website and App', 'Website and app design for music festival', '<p>The Stargazer music festival website uses a highly typographic treatment to communicate the high calbre performers who will be appearing. As well as allowing users to view the line-up and purchase tickets, the website also allows them to plan their itineraries and book food.</p>', '2021-03-17 18:01:19', 2, 3, 11, 1, 'stargazer-website-and-app'),
(12, 'The Ice Palace', 'Book cover design', '<p>This cover is for a Chimney Press reissue of the Norwegian classic novel, The Ice Palace. The design reflects the concise style of the writing and the sense of unease that appears throughout, almost as its own frozen character. The binding uses linen and a thick cover keeps its secrets close to its chest.</p>', '2021-03-20 11:24:52', 1, 2, 12, 1, 'the-ice-palace'),
(13, 'Chimney Press Website', 'Website for book publisher', '<p>This design was based on extensive research into the perception of the Chimney Press brand across multiple channels. The insights gained showed that customers were very keen to keep informed on new and upcoming releases and also to share this information throughout their social networks.</p>', '2021-03-21 08:44:01', 2, 2, 13, 1, 'chimney-press-website'),
(14, 'Milk Beach Album Cover', 'Packaging for music series', '<p>Having commissioned a number of photographs of the intertidal rocks that adorn the eponymous Milk Beach, this packaging creates a beautiful and serene context for the hugely successful music series. Natural, recycled cardstocks and gentle colorways were used throughout.</p>', '2021-03-27 13:15:20', 1, 1, 14, 1, 'milk-beach-album-cover'),
(15, 'Seascape', 'Photograph for art exhibition', '<p>This shot of tbe sea at Margate was included in a group show at the Turner Contemporary art gallery in Kent, England. Printed at a large scale, the serene viewpoint reveals a timeless beauty to the briny waters that have lured Londoners to it for centuries.</p>', '2021-04-03 19:36:08', 4, 2, 15, 1, 'seascape'),
(16, 'Polite Society Website', 'Website for fashion label', '<p>The Polite Society website was rebuilt from the ground up with a complete evaluation of the old version and adjustments to the new user experience to respond to it. As well as working on multiple devices, a new back-end was built to encompass the expanding nature of the company.</p>', '2021-04-06 10:21:44', 2, 1, 16, 1, 'polite-society-website'),
(17, 'Snow Search', 'Graphics for mobile game', '<p>These illustrations of a young boy and his dog formed the basis for a highly successful animated game called Snow Search. The game, which was designed for mobile devices, received several awards for game design and mechanics. More illustration work is currently underway for a sequel.</p>', '2021-04-08 08:46:31', 3, 3, 17, 1, 'snow-search'),
(18, 'Floral Website', 'Website for florist', '<p>This florist in Brooklyn required an updated website to support the expanding scope of their business. Working in association with a stylist and a photographer, we created a pleasant and straightforward user experience. Since the relaunch, online enquiries have increased.</p>', '2021-04-08 17:05:19', 2, 1, 18, 1, 'floral-website'),
(19, 'Abandoned Industry', 'Photograph for magazine feature', '<p>This photograph of old industrial equipment on a disused dock appeared alongside an essay in a magazine about urban-planning and regeneration. The brief was to consider the visual beauty inherent in decay and inspire readers to embrace sustainable idealogies within the contemporary landscape.</p>', '2021-04-11 10:52:02', 4, 2, 21, 1, 'abandoned-industry'),
(20, 'Chimney Business Cards', 'Stationery design for publishing company', '<p>Along with several other items of branded stationery, Chimney Press required new business cards for their expanding office staff. In keeping with their company mission of re-releasing older book titles, a clean and vintage-inspired aesthetic informed the otherwise modern design.</p>', '2021-04-15 09:04:39', 1, 2, 20, 1, 'chimney-business-cards'),
(21, 'Stargazer', 'Illustrations for music festival', '<p>A series of illustrations were commissioned for the Stargazer music festivals range of promotional materials. A creative choice was made not to portray the night sky itself (as in previous years) but to focus on the beauty and wonder inherent in the patrons themselves.</p>', '2021-04-19 18:08:11', 3, 3, 23, 1, 'stargazer'),
(22, 'Polite Society Posters', 'Poster designs for fashion label', '<p>These posters were designed to increase brand awareness in fashion districts as part of an international campaign ahead of the upcoming autumn-winter season. The client required something aesthetically modern that introduced the vibrant palette of the new collection.</p>', '2021-04-22 07:49:27', 1, 1, 2, 1, 'Polite-Society-Posters'),
(23, 'Golden Brown', 'Photograph for interior design book', '<p>This photograph is one of a range that appears in a book about interior design called Golden Brown. The interiors featured in the book show the current trend for looking back to the 1970\'s and the colour treatment of the photography reflects this warm, earthy palette.</p>', '2021-04-25 13:51:19', 4, 3, 22, 1, 'golden-brown'),
(24, 'Travel Guide', 'Book design for series of travel guides', '<p>The best-selling travel guide series, <strong>Featherview</strong>, required a refreshed look and feel for their latest series of books covering the Asian region. They were after a clean and concise solution - a versatile design that could accommodate both the coffee table and the backpack.</p>', '2021-04-25 19:11:42', 1, 1, 24, 1, 'travel-guide'),
(25, 'Buddha', 'Photograph for magazine article', '<p>The article this photograph accompanies is about the growing popularity of mindfulness meditation in the mental health industry today. The text traces the history of mindfulness back to its Buddhist origins.</p>', '2021-08-03 09:30:19', 4, 12, 25, 1, 'buddha'),
(26, 'Faces in the Water', 'Book cover design', '<p>Chimney Press requested a book cover design for this poignant portrayal of a woman\'s experience in a psychiatric facility. The typographic treatment intends to mimic the movement of water across the surface of a body of water and I feel it resonates with the highly poetic and sensitive subject matter.</p>', '2021-08-03 12:11:24', 1, 8, 26, 1, 'faces-in-the-water'),
(27, 'Salmon', 'Photograph for restaurant review', '<p>This photograph was part of a series shot at a new seafood restaurant to appear alongside a review in the New York Times. Care was taken to ensure the series reflected the fresh, organic menu and \"clean-eating\" minimalist aesthetic of the restaurant itself.</p>', '2021-08-03 09:23:07', 4, 10, 27, 1, 'salmon'),
(28, 'Quiet', 'Book cover design', '<p>This cover design is for a book about silent movies and is based on the dialogue boards they used. The card stock for the cover is designed to look slightly old and dusty and uses rough-textured recycled materials to give the ink a nice matte effect.</p>', '2021-08-03 11:21:04', 1, 7, 28, 1, 'quiet'),
(29, 'Quiet Invite', 'Invitation design for documentary', '<p>This invitation was designed for the world premiere and launch party of a new documentary by Claude Dupont titled \"Quiet: A Silent Film History.\" It was important to make it visually cohesive with the book that I also designed for the same feature.</p>', '2021-08-03 11:26:29', 1, 7, 29, 1, 'quiet-invite'),
(30, 'Museum', 'Photography for a museum', '<p>The MAXII museum (Museo Nazionale delle Arti del XXI Secolo) in Rome, Italy was designed by Zaha Hadid and is dedicated to contemporary art and architecture. This assignment was to capture the neon installation on its exterior by Italian artist, Maurizio Nannucci.</p>', '2021-08-03 09:06:12', 4, 5, 30, 1, 'museum'),
(31, 'New Forest', 'Website design for artist retreat', '<p>This website for a retreat in the New Forest was designed to inspire artists and writers to consider it the perfect location in which to create. The layout is clean and classical to allow the photography to communicate the beautiful surroundings.</p>', '2021-08-04 10:04:37', 2, 7, 31, 1, 'new-forest');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navigation` tinyint(1) NOT NULL,
  `seo_name` varchar(244) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `navigation`, `seo_name`) VALUES
(1, 'Print', 'Inspiring graphic design and visual communication for print and packaging', 1, 'print'),
(2, 'Digital', 'Websites and apps that push digital design to its limits on all devices', 1, 'digital'),
(3, 'Illustration', 'Visual storytellers specialising in hand drawn and vector illustrations', 1, 'illustration'),
(4, 'Photography', 'Capturing images that transport the viewer to the moment they were taken', 1, 'Photography');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(12) NOT NULL,
  `comment` varchar(4000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_id` int(12) NOT NULL,
  `member_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `posted`, `article_id`, `member_id`) VALUES
(1, 'Love this, totally makes me want to visit Japan again. Really clean design, with an organised format for the information and great picture pages.', '2021-03-14 17:45:13', 24, 3),
(2, 'I bought one of these guides for NYC last year and the design really made an impact on me. Its a beautiful product and lovely design. Well done!', '2021-03-14 17:45:15', 24, 6),
(3, 'Another great piece of work Ivy, thanks for sharing it with us.', '2021-03-14 17:53:52', 24, 7),
(4, 'Oooh! So nice! Putting it on my book list now.', '2021-03-14 17:53:54', 24, 9),
(5, 'Wow! Really like the lighting for this shot.', '2021-04-03 21:22:53', 23, 4),
(6, 'Another great piece of design, Ivy!', '2021-04-04 20:15:12', 24, 4),
(7, 'Those green chairs are beautiful.', '2021-06-30 17:45:43', 23, 1),
(8, 'Lovely box ', '2021-07-03 11:21:13', 20, 1),
(9, 'This is beautiful work!', '2021-08-03 23:14:49', 28, 6),
(10, 'This is super inspiring! I like the typographic treatment on the homepage especially.', '2021-08-09 21:35:16', 31, 1),
(11, 'What typeface did you use for the title?', '2021-08-09 21:36:31', 28, 12),
(12, 'Thanks so much, everybody!', '2021-08-10 11:08:37', 24, 1),
(13, 'I love the illustration on the cover. It reminds me of children\'s books I grew up with. And the type goes really well with it.', '2021-08-15 13:40:59', 26, 1),
(14, 'The collage style on this is so cute.', '2021-08-18 08:14:08', 17, 7),
(15, 'This is such an amazing building - really like how you captured it.', '2021-08-21 15:34:37', 30, 7),
(16, 'I bet this looks amazing big, you\'d really see the hand drawn element of it.', '2021-08-22 11:17:50', 10, 5),
(17, 'I\'m so into the full-bleed photography and gentle colors of this.', '2021-08-27 21:49:29', 31, 6),
(18, 'This is a great photo, Emiko! Love it.', '2021-09-03 01:15:30', 23, 6),
(19, 'Absolutely. Not what you expect to find in Rome, and love the light in this shot.', '2021-09-05 17:22:35', 30, 11),
(20, 'Great choices of colors. And the simple type is lovely.', '2021-09-07 08:53:11', 22, 11),
(21, 'The duotone-look is fab!', '2021-09-07 09:01:32', 9, 11),
(22, 'Bet this would look awesome printed on a Risograph.', '2021-09-11 22:21:54', 9, 9),
(23, 'Yeah! And its so nice the way it gets more realistic towards the back.', '2021-09-13 14:00:42', 17, 12),
(24, 'This is really clever. Great work.', '2021-09-13 16:56:36', 17, 10),
(25, 'The album cover for this in the print section is great, too.', '2021-09-15 12:42:07', 9, 3),
(26, 'Nice work, Luke!', '2021-09-18 20:18:10', 13, 3),
(27, 'The series of these are all really nice. The photo and the album cover work really well, too.', '2021-09-21 11:16:28', 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `file` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `file`, `alt`) VALUES
(1, 'systemic-brochure.jpg', 'Brochure for Systemic science festival'),
(2, 'polite-society-posters.jpg', 'Posters for Polite Society'),
(3, 'swimming-pool.jpg', 'Photograph of swimming pool'),
(4, 'birds.jpg', 'Collage of two birds'),
(5, 'sisters.jpg', 'Illustration of two sisters'),
(6, 'micro-dunes.jpg', 'Photograph of tiny sand dunes'),
(7, 'milk-beach.jpg', 'Website for Milk Beach'),
(8, 'wellness.jpg', 'Yoga timetable for Wellness'),
(9, 'milk-beach-skyline.jpg', 'Photograph of Sydney Harbour from Milk Beach'),
(10, 'polite-society-mural.jpg', 'Mural for Polite Society'),
(11, 'stargazer.jpg', 'Line-up for Stargazer website'),
(12, 'the-ice-palace.jpg', 'The Ice Palace book cover'),
(13, 'chimney.jpg', 'Website for Chimney Press'),
(14, 'milk-beach-album.jpg', 'Vinyl LP cover for Milk Beach'),
(15, 'seascape.jpg', 'The sea taken at Margate Beach'),
(16, 'polite-society.jpg', 'Website for Polite Society'),
(17, 'snow-search.jpg', 'Illustration of boy in snow'),
(18, 'floral.jpg', 'Floral Website'),
(19, 'forecast.jpg', 'Illustration of handbags'),
(20, 'chimney-cards.jpg', 'Business cards for Chimney Press'),
(21, 'abandoned.jpg', 'Photograph of disused cranes'),
(22, 'golden-brown.jpg', 'Photograph of the interior of a cafe'),
(23, 'stargazer-mascot.jpg', 'Illustration of girl looking at the sky'),
(24, 'featherview.jpg', 'Internal pages from travel book'),
(25, 'buddha.jpg', 'Buddha statue in a pond'),
(26, 'faces.jpg', 'Cover of Faces in the Water by Janet Frame'),
(27, 'salmon.jpg', 'Salmon with zucchini ribbons'),
(28, 'quiet.jpg', 'Cover of Quiet - A Silent Film History'),
(29, 'quiet-invite.jpg', 'Invitation for film premiere'),
(30, 'museum.jpg', 'Facade of the MAXII museum in Rome'),
(31, 'new-forest.jpg', 'New Forest Retreat website on iPad Pro');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `article_id` int(8) NOT NULL,
  `member_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`article_id`, `member_id`) VALUES
(2, 1),
(4, 1),
(13, 1),
(15, 1),
(16, 1),
(18, 1),
(20, 1),
(21, 1),
(23, 1),
(24, 1),
(26, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(1, 3),
(7, 3),
(9, 3),
(10, 3),
(13, 3),
(14, 3),
(19, 3),
(22, 3),
(24, 3),
(27, 3),
(30, 3),
(31, 3),
(19, 4),
(23, 4),
(13, 5),
(16, 5),
(19, 5),
(22, 5),
(24, 5),
(1, 6),
(12, 6),
(15, 6),
(21, 6),
(23, 6),
(31, 6),
(10, 7),
(11, 7),
(19, 7),
(23, 7),
(30, 7),
(2, 8),
(4, 8),
(5, 8),
(6, 8),
(9, 8),
(17, 8),
(18, 8),
(23, 8),
(25, 8),
(28, 8),
(29, 8),
(9, 9),
(10, 9),
(11, 9),
(19, 9),
(20, 9),
(21, 9),
(23, 9),
(24, 9),
(26, 9),
(9, 10),
(18, 10),
(20, 10),
(23, 10),
(25, 10),
(9, 11),
(17, 11),
(21, 11),
(22, 11),
(31, 11),
(9, 12),
(10, 12),
(11, 12),
(17, 12),
(19, 12),
(21, 12),
(23, 12),
(26, 12),
(30, 12),
(31, 12);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `forename` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `forename`, `surname`, `email`, `password`, `joined`, `picture`, `role`) VALUES
(1, 'Ivy', 'Stone', 'ivy@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-01-26 12:04:23', 'ivy.jpg', 'admin'),
(2, 'Luke', 'Wood', 'luke@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2018-02-01 21:48:25', NULL, 'member'),
(3, 'Emiko', 'Ito', 'emi@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-02-12 10:53:47', 'emi.jpg', 'member'),
(4, 'Dot', 'Clarke', 'dot@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-04 08:21:28', 'dot.jpg', 'admin'),
(5, 'Henry', 'Bell', 'henry@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-06 23:47:56', 'henry.jpg', 'member'),
(6, 'Samira', 'Mirza', 'samira@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-08 12:12:53', 'samira.jpg', 'admin'),
(7, 'Eve', 'Howard', 'eve@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-13 23:49:40', 'eve.jpg', 'member'),
(8, 'Lily', 'Morgan', 'lily@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-14 11:04:30', 'lily.jpg', 'member'),
(9, 'Aiden', 'Peterson', 'aiden@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-16 17:51:17', 'aiden.jpg', 'member'),
(10, 'Hyun-tae', 'Lee', 'hyun@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-16 21:32:27', 'hyun.jpg', 'member'),
(11, 'Piper', 'Gray', 'piper@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-18 08:18:23', 'piper.jpg', 'member'),
(12, 'Grace', 'Jackson', 'grace@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-18 12:55:09', 'grace.jpg', 'member'),
(13, 'Noriko', 'Saito', 'noriko@eg.link', '$2y$10$MAdTTCA0Mi0whewgCcBv4uv0HUgdcAkW1pnqslSi/P2Ca9u5rpZl.', '2021-03-21 15:28:11', 'noriko.jpg', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` int(255) NOT NULL,
  `expires` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `member_id`, `expires`, `purpose`) VALUES
(1, '0d9781153ed42ea7d72b4a4963dbd4f7fbc1d09bca10a8faae55d5dd66441521881a4e51eb17cd62596b156f11218d31436e5ae3381bcb50acbf31dd2c5cd197', 50, '2021-09-09 15:47:04', 'password_reset');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`member_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Article id exists` (`article_id`),
  ADD KEY `Member id exists` (`member_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`article_id`,`member_id`),
  ADD UNIQUE KEY `article_id` (`article_id`,`member_id`),
  ADD KEY `article_id_2` (`article_id`,`member_id`),
  ADD KEY `Is member id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `category_exists` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `image_exists` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `member_exists` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Article id exists` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `Member id exists` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `Is article id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `Is member id` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);
