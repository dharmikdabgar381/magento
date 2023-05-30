<?php
$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `practice`;
CREATE TABLE `practice` (
  `practice_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `cost` decimal(11,3) NOT NULL,
  `price` decimal(11,3) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `practice`
  ADD PRIMARY KEY (`practice_id`);

ALTER TABLE `practice`
  MODIFY `practice_id` int(11) NOT NULL AUTO_INCREMENT;

");

$installer->endSetup();
?>