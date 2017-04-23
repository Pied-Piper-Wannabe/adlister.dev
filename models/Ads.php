<?php

require_once __DIR__ . '/Model.php';

class Ads extends Model {
    protected static $table = 'ads';

    public static function count($cat = "") {
        self::dbConnect();
        $stmt = self::$dbc->query("SELECT COUNT(*) FROM " . static::$table . $cat);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $count = $row[0];

        return $count;
    }

    public static function paginate($pageNo, $cat, $resultsPerPage = 10) {
        self::dbConnect();
        $limit = $resultsPerPage;
        $offset = ($pageNo * $limit) - $limit;

        $stmt = self::$dbc->prepare("SELECT * FROM " . static::$table . $cat . " LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return($results);
    }

    public static function latest() {
        self::dbConnect();

        $stmt = self::$dbc->prepare("SELECT * FROM " . static::$table . " ORDER BY id DESC LIMIT 3");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return($results);
    }

    public static function insertAd($name, $category, $brand, $price, $description, $photodir = "", $user_id = "1") {
        self::dbConnect();

        $insert = "INSERT INTO " . self::$table . " (name, category, brand, price, description, photodir, user_id)
        VALUES (:name, :category, :brand, :price, :description, :photodir, :user_id)";
        $statement = self::$dbc->prepare($insert);

        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':category', $category, PDO::PARAM_STR);
        $statement->bindValue(':brand', $brand, PDO::PARAM_STR);
        $statement->bindValue(':price', $price, PDO::PARAM_STR);
        $statement->bindValue(':description', $description, PDO::PARAM_STR);
        $statement->bindValue(':photodir', $photodir, PDO::PARAM_STR);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
    }

}
