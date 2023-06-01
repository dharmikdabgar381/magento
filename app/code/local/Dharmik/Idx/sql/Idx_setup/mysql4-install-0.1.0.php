<?php
$installer = $this;

$installer->startSetup();


$installer->run("
DROP TABLE IF EXISTS `import_product_idx`;
CREATE TABLE `import_product_idx` (
  `index` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(11,3) NOT NULL,
  `cost` decimal(11,3) NOT NULL,
  `quntity` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `collection` varchar(50) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `import_product_idx`
  ADD PRIMARY KEY (`index`);

ALTER TABLE `import_product_idx`
  MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;
  ");

$installer->endSetup();
?>