<?php

class ChatRoom {

    /** @var DatabaseConnection */
    private $databaseConnection = null;

    private $course_id = null;
    private $senders = null;
    private $dates = null;
    private $messages = null;

    public function __construct($databaseConnection, $course_id) {
        $this->databaseConnection = $databaseConnection;
        $this->course_id = $course_id;

        $this->senders = array();
        $this->dates = array();
        $this->messages = array();
    }

    public function fetchMessages() {
        $this->databaseConnection->initiateConnection();
        $connection = $this->databaseConnection->getConnection();

        $sql_query = "SELECT * FROM MESSAGES";
        $sql_result = mysqli_query($connection, $sql_query);

        while ($row = mysqli_fetch_assoc($sql_result)) {
            $this->senders[] = $row['SENDER_ID'];
            $this->dates[] = $row['DATE'];
            $this->messages[] = $row['MESSAGE'];
        }

        $this->databaseConnection->killConnection();
    }

    public function printAll() {
        for ($i = 0; $i < count($this->messages); $i++) {
            echo 'User: ' . $this->senders[$i] . ' said (' . $this->dates[$i] . ') ' . $this->messages[$i] . '<br>';
        }
    }
}

?>