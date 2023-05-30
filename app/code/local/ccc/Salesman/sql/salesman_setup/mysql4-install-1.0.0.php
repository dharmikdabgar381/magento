<?php
$installer = $this;

$installer->startSetup();


$installer->run("
DROP TABLE IF EXISTS `salesman`;
CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT;
  ");

$installer->endSetup();
?>