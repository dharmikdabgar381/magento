<?php

class Ccc_Practice_Adminhtml_CsvController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $categoryCsvFilePath = "C:/Users/admin/Desktop/1SB/CATEGORY.csv";
        $attributeOptionCsvFilePath = "C:/Users/admin/Desktop/1SB/ATTRIBUTE-OPTIONS.csv";
        $finalCsvFilePath = 'category-attribute-option.csv';
        
        $finalCsvFile = fopen($finalCsvFilePath, 'w');

        $header = ['Category ID', 'Category Name', 'Attribute ID', 'Option'];
        fputcsv($finalCsvFile, $header);

        $categoryCsvData = array_map('str_getcsv', file($categoryCsvFilePath));
        $categoryData = array_unique(array_column($categoryCsvData, 1)); // Get unique category names
        $categoryData = array_values($categoryData); // Reindex the array
        $categoryHeaders = array_shift($categoryData); // Remove the header row

        $attributeOptionData = array_map('str_getcsv', file($attributeOptionCsvFilePath));
        $attributeOptionData = array_unique($attributeOptionData, SORT_REGULAR);
        $attributeOptionHeaders = array_shift($attributeOptionData); // Remove the header row

        foreach ($categoryData as $categoryName) {
            $categoryId = null;
            foreach ($categoryCsvData as $categoryRow) {
                if ($categoryRow[1] === $categoryName) {
                    $categoryId = $categoryRow[0];
                    break;
                }
            }

            $writtenCombinations = [];

            foreach ($attributeOptionData as $attributeOptionRow) {
                $attributeId = $attributeOptionRow[0];
                $option = $attributeOptionRow[1];

                $combinationKey = $attributeId . '_' . $option;

                if (!isset($writtenCombinations[$combinationKey])) {
                    $row = [$categoryId, $categoryName, $attributeId, $option];
                    fputcsv($finalCsvFile, $row);

                    $writtenCombinations[$combinationKey] = true;
                }
            }
        }

        fclose($finalCsvFile);

        $this->_prepareDownloadResponse('category-attribute-option.csv', file_get_contents($finalCsvFilePath));

    }
}
