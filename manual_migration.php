<?php

// Manual migration script to update pages table
try {
    $pdo = new PDO('mysql:host=localhost;dbname=istethmar;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    
    // Check if content_ar and content_en columns exist
    $stmt = $pdo->query("SHOW COLUMNS FROM pages LIKE 'content_%'");
    $existing_columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (!in_array('content_ar', $existing_columns)) {
        echo "Adding content_ar column...\n";
        $pdo->exec("ALTER TABLE pages ADD COLUMN content_ar LONGTEXT NULL AFTER description");
    } else {
        echo "content_ar column already exists\n";
    }
    
    if (!in_array('content_en', $existing_columns)) {
        echo "Adding content_en column...\n";
        $pdo->exec("ALTER TABLE pages ADD COLUMN content_en LONGTEXT NULL AFTER content_ar");
    } else {
        echo "content_en column already exists\n";
    }
    
    // Check if old columns exist before dropping them
    $stmt = $pdo->query("SHOW COLUMNS FROM pages");
    $all_columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $columns_to_drop = ['html_content', 'html_content_en', 'html_content_ar', 'css_styling', 'js_functionality'];
    
    foreach ($columns_to_drop as $column) {
        if (in_array($column, $all_columns)) {
            echo "Dropping column: $column\n";
            $pdo->exec("ALTER TABLE pages DROP COLUMN `$column`");
        } else {
            echo "Column $column does not exist, skipping\n";
        }
    }
    
    echo "Migration completed successfully!\n";
    
    // Show final table structure
    echo "\nFinal table structure:\n";
    $stmt = $pdo->query("DESCRIBE pages");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "- {$column['Field']} ({$column['Type']})\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
