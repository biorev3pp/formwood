CREATE TABLE `permission_modules` (
  `id` int(10) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `permission` text,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `permission_modules` (`id`, `name`, `permission`, `updated_at`, `created_at`) VALUES
(1, 'Community', '{\"1\":\"Listing\",\"2\":\"Create\",\"3\":\"Update\",\"4\":\"Delete\"}', '2022-08-31 05:59:05', '2022-08-31 11:29:04'),
(2, 'Home', '{\"1\":\"Listing\",\"2\":\"Create\",\"3\":\"Update\",\"4\":\"Delete\"}', '2022-08-31 05:59:05', '2022-08-31 11:29:04'),
(3, 'Homeplan', '{\"1\":\"Listing\",\"2\":\"Create\",\"3\":\"Update\",\"4\":\"Delete\"}', '2022-08-31 05:59:05', '2022-08-31 11:29:04');


ALTER TABLE `permission_modules`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `permission_modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

CREATE TABLE `modules` (
  `id` int(10) NOT NULL,
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`) VALUES
(1, 'Community'),
(2, 'Home'),
(3, 'Contact Us');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;