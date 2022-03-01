--
-- Database: `phpbook-1`
-- This is the first database used in the PHP & MySQL book
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
  `published` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `summary`, `content`, `created`, `category_id`, `member_id`, `image_id`, `published`) VALUES
(1, 'Systemic Brochure', 'Brochure design for science festival', 'This brochure design is part of a suite of advertising materials that promote the Systemic science festival. These materials feature the complex visual identity that is an abstract grid of pathways representing choice and decision-making in designing complex systems.', '2021-01-26 12:21:03', 1, 2, 1, 1),
(2, 'Forecast', 'Handbag illustration for fashion magazine', 'This drawing was commissioned by a fashion magazine for an article about spotting future trends. This piece uses luxury handbags to mimic clouds in a kind of fashion-based weather forecast-style graphic. The use of repetition and pattern highlights the potential power of a single prediction.', '2021-01-28 19:44:03', 3, 2, 2, 1),
(3, 'Swimming Pool', 'Architecture magazine photography', 'This photograph is one of a series commissioned for an article in an architectural magazine featuring swimming pools in private residences. The variety of locations shared a similar mid-century modern aesthetic and were rendered using a grainy, black and white film stock.', '2021-02-02 09:45:52', 4, 1, 3, 1),
(4, 'Walking Birds', 'Artwork for music video', 'The brief for this music video was to combine a psychedelic sixties vibe with a granola-brown seventies aesthetic and morph it into a Sesame Street-style animation. With over two million views online, the artwork successfully promoted the song across multiple social media channels.', '2021-02-12 11:05:35', 3, 3, 4, 1),
(5, 'Sisters', 'Editorial graphics for psychology article', 'The article that these illustrations accompany highlights the changing landscape of family connections in the modern age as compared to fifty years ago. The brief was to visualize the interpersonal drift caused by increased dispersement of communities across the globe.', '2021-02-26 15:31:16', 3, 3, NULL, 1),
(6, 'Micro-Dunes', 'Photography for scientific journal', 'This photograph was commissioned to accompany a scientific article about micro-ecologies in the coastal environment. Due to the miniature scale of the subject matter, a macro lens was used to capture the fine detail. It was shot on location on the mid-north coast of Australia.', '2021-03-02 21:02:47', 4, 1, 6, 1),
(7, 'Milk Beach Website', 'Website for music series', 'Using the imagery commissioned for the album artwork, this website aims to provide a simple channel for users to listen to the music digitally. Care was taken to ensure fans of the music could connect with the brand and keep updated on future offerings.', '2021-03-06 10:16:22', 2, 1, 7, 1),
(8, 'Wellness App', 'App for health facility', 'The Wellness chain of health facilities required an app that allowed members to view and book classes. The existing brand style guide defined the overall look and feel of the site with the main goal of the design to be as minimalistic as possible.', '2021-03-12 14:45:49', 2, 2, 8, 1),
(9, 'Milk Beach Music', 'Photography for a music series', 'The music label that released this series wanted to capture the beach that inspired its creation. A number of photographs (including panoramic views and close-ups) were shot on location at Milk Beach in Sydney, Australia. They were given a duotone appearance in post-production.', '2021-03-12 17:09:40', 4, 1, 9, 1),
(10, 'Polite Society Mural', 'Large-scale illustrations for fashion label', 'This is one of several illustrations commissioned by fashion label, Polite Society, to decorate their new autumn-winter collection displays. Appearing in various forms (such as murals, digital projections, and in print) they represent the modern aesthetic of the latest range.', '2021-03-16 14:14:40', 3, 1, 10, 1),
(11, 'Stargazer Website and App', 'Website and app design for music festival', 'The Stargazer music festival website uses a highly typographic treatment to communicate the high calbre performers who will be appearing. As well as allowing users to view the line-up and purchase tickets, the website also allows them to plan their itineraries and book food.', '2021-03-17 18:01:19', 2, 3, 11, 1),
(12, 'The Ice Palace', 'Book cover design', 'This cover is for a Chimney Press reissue of the Norwegian classic novel, The Ice Palace. The design reflects the concise style of the writing and the sense of unease that appears throughout, almost as its own frozen character. The binding uses linen and a thick cover keeps its secrets close to its chest.', '2021-03-20 11:24:52', 1, 2, 12, 1),
(13, 'Chimney Press Website', 'Website for book publisher', 'This design was based on extensive research into the perception of the Chimney Press brand across multiple channels. The insights gained showed that customers were very keen to keep informed on new and upcoming releases and also to share this information throughout their social networks.', '2021-03-21 08:44:01', 2, 2, 13, 1),
(14, 'Milk Beach Album Cover', 'Packaging for music series', 'Having commissioned a number of photographs of the intertidal rocks that adorn the eponymous Milk Beach, this packaging creates a beautiful and serene context for the hugely successful music series. Natural, recycled cardstocks and gentle colorways were used throughout.', '2021-03-27 13:15:20', 1, 1, 14, 1),
(15, 'Seascape', 'Photograph for art exhibition', 'This shot of tbe sea at Margate was included in a group show at the Turner Contemporary art gallery in Kent, England. Printed at a large scale, the serene viewpoint reveals a timeless beauty to the briny waters that have lured Londoners to it for centuries.', '2021-04-03 20:36:08', 4, 2, 15, 1),
(16, 'Polite Society Website', 'Website for fashion label', 'The Polite Society website was rebuilt from the ground up with a complete evaluation of the old version and adjustments to the new user experience to respond to it. As well as working on multiple devices, a new back-end was built to encompass the expanding nature of the company.', '2021-04-06 11:21:44', 2, 1, 16, 1),
(17, 'Snow Search', 'Graphics for mobile game', 'These illustrations of a young boy and his dog formed the basis for a highly successful animated game called Snow Search. The game, which was designed for mobile devices, received several awards for game design and mechanics. More illustration work is currently underway for a sequel.', '2021-04-08 09:46:31', 3, 3, 17, 1),
(18, 'Floral Website', 'Website for florist', 'This florist in Brooklyn required an updated website to support the expanding scope of their business. Working in association with a stylist and a photographer, we created a pleasant and straightforward user experience. Since the relaunch, online enquiries have increased.', '2021-04-08 18:05:19', 2, 1, 18, 1),
(19, 'Abandoned Industry', 'Photograph for magazine feature', 'This photograph of old industrial equipment on a disused dock appeared alongside an essay in a magazine about urban-planning and regeneration. The brief was to consider the visual beauty inherent in decay and inspire readers to embrace sustainable idealogies within the contemporary landscape.', '2021-04-11 11:52:02', 4, 2, 19, 1),
(20, 'Chimney Business Cards', 'Stationery design for publishing company', 'Along with several other items of branded stationery, Chimney Press required new business cards for their expanding office staff. In keeping with their company mission of re-releasing older book titles, a clean and vintage-inspired aesthetic informed the otherwise modern design.', '2021-04-15 10:04:39', 1, 2, 20, 1),
(21, 'Stargazer', 'Illustrations for music festival', 'A series of illustrations were commissioned for the Stargazer music festivals range of promotional materials. A creative choice was made not to portray the night sky itself (as in previous years) but to focus on the beauty and wonder inherent in the patrons themselves.', '2021-04-19 19:08:11', 3, 3, 21, 1),
(22, 'Polite Society Posters', 'Poster designs for a fashion label', 'These posters were designed to increase brand awareness in fashion districts as part of an international campaign ahead of the upcoming autumn-winter season. The client required something aesthetically modern that introduced the vibrant palette of the new collection.', '2021-04-22 08:49:27', 1, 1, 22, 1),
(23, 'Golden Brown', 'Photograph for interior design book', 'This photograph is one of a range that appears in a book about interior design called Golden Brown. The interiors featured in the book show the current trend for looking back to the 1970\'s and the colour treatment of the photography reflects this warm, earthy palette.', '2021-04-25 13:51:19', 4, 3, 23, 1),
(24, 'Travel Guide', 'Book design for series of travel guides', 'The best-selling travel guide series, Featherview, required a refreshed look and feel for their latest series of books covering the Asian region. They were after a clean and concise solution - a versatile design that could accommodate both the coffee table and the backpack.', '2021-04-25 20:11:42', 1, 1, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navigation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `navigation`) VALUES
(1, 'Print', 'Inspiring graphic design', 1),
(2, 'Digital', 'Powerful pixels', 1),
(3, 'Illustration', 'Hand-drawn visual storytelling', 1),
(4, 'Photography', 'Capturing the moment', 1);

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
(1, 'systemic-brochure.jpg', 'Brochure for Systemic Science Festival'),
(2, 'forecast.jpg', 'Illustration of a handbag'),
(3, 'swimming-pool.jpg', 'Photograph of swimming pool'),
(4, 'birds.jpg', 'Collage of two birds'),
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
(18, 'floral.jpg', 'Floral website design'),
(19, 'abandoned.jpg', 'Photograph of decommissioned dock cranes'),
(20, 'chimney-cards.jpg', 'Business cards for Chimney Press'),
(21, 'stargazer-mascot.jpg', 'Illustration of girl looking towards sky'),
(22, 'polite-society-posters.jpg', 'Photograph of three posters for Polite Society'),
(23, 'golden-brown.jpg', 'Photograph of the interior of a cafe'),
(24, 'featherview.jpg', 'Two pages from a travel book showing Nijo Castle');

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
  `picture` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `forename`, `surname`, `email`, `password`, `joined`, `picture`) VALUES
(1, 'Ivy', 'Stone', 'ivy@eg.link', 'c63j-82ve-2sv9-qlb38', '2021-01-26 12:04:23', 'ivy.jpg'),
(2, 'Luke', 'Wood', 'luke@eg.link', 'saq8-2f2k-3nv7-fa4k', '2021-01-26 12:15:18', NULL),
(3, 'Emiko', 'Ito', 'emi@eg.link', 'sk3r-vd92-3vn1-exm2', '2021-02-12 10:53:47', 'emi.jpg');

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
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
