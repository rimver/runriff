<?php
/*
 * ---------------------------------------------------------------
 * CONTENT HELPER
 * ---------------------------------------------------------------
 *
 * This file contains helper functions for the application.
 */

/**
 * Fetches a piece of content from the database by its key.
 *
 * This function uses a static variable to cache the content for the
 * duration of the request, preventing multiple database queries for
 * content on the same page load.
 *
 * @param string $key The key of the content to retrieve.
 * @param string $default A default value to return if the key is not found.
 * @return string The content value.
 */
function getContent(string $key, string $default = ''): string {
    static $content = null;

    if ($content === null) {
        // This is the first call, so we fetch all content from the DB.
        require __DIR__ . '/database.php';
        $content = [];
        try {
            $sql = "SELECT content_key, content_value FROM content";
            $stmt = $pdo->query($sql);
            if ($stmt) {
                $content = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            }
        } catch (PDOException $e) {
            // If the table doesn't exist or there's an error, we'll return defaults.
            // This makes the site partially usable even if the DB setup isn't complete.
            error_log("Could not fetch content from database: " . $e->getMessage());
        }
    }

    return htmlspecialchars($content[$key] ?? $default);
}
?>
