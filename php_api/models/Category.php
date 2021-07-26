<?php

class Category {
    //DB staff
    private $conn;
    private $table = 'categories';

    //Properties
    public $id;
    public $name;
    public $created_at;

    //Construct
    public function __construct( $db ) {
        $this->conn = $db;
    }

    /**
     * Read all categories
     *
     * @return void
     */
    public function read() {
        //Create query
        $query = 'SELECT id, name, created_at FROM ' . $this->table . ' ORDER BY created_at DESC';

        //Prepare statement
        $stmt = $this->conn->prepare( $query );

        //Execute Query
        $stmt->execute();

        return $stmt;
    }

    /**
     * Read single category
     *
     * @return void
     */
    public function read_single() {
        //Create query
        $query = 'SELECT id, name, created_at FROM ' . $this->table . ' WHERE id = :id LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare( $query );

        // Bind ID
        $stmt->bindParam( ':id', $this->id );

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch( PDO::FETCH_ASSOC );

        // Set Properties
        $this->id = $row['id'];
        $this->name = $row['name'];
    }

    /**
     * Create category
     *
     * @return void
     */
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . ' SET name= :name';

        //Prepare statement
        $stmt = $this->conn->prepare( $query );

        //Clean data
        $this->id = htmlspecialchars( strip_tags( $this->id ) );

        // Bind ID
        $stmt->bindParam( ':name', $this->name );

        try {
            $stmt->execute();

            return true;
        } catch ( PDOException $e ) {
            printf( "Error: %s \n", $e->getMessage() );

            return false;
        }
    }

    /**
     * Update category
     *
     * @return void
     */
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . ' SET name= :name WHERE id= :id';

        //Prepare statement
        $stmt = $this->conn->prepare( $query );

        //Clean data
        $this->name = htmlspecialchars( strip_tags( $this->name ) );
        $this->id = htmlspecialchars( strip_tags( $this->id ) );

        // Bind ID
        $stmt->bindParam( ':name', $this->name );
        $stmt->bindParam( ':id', $this->id );

        try {
            $stmt->execute();

            return true;
        } catch ( PDOException $e ) {
            printf( "Error: %s \n", $e->getMessage() );

            return false;
        }
    }

    /**
     * Delete category
     *
     * @return void
     */
    public function delete() {
        //Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id= :id';

        //Prepare statement
        $stmt = $this->conn->prepare( $query );

        //Clean data
        $this->id = htmlspecialchars( strip_tags( $this->id ) );

        // Bind ID
        $stmt->bindParam( ':id', $this->id );

        try {
            $stmt->execute();

            return true;
        } catch ( PDOException $e ) {
            printf( "Error: %s \n", $e->getMessage() );

            return false;
        }
    }

}