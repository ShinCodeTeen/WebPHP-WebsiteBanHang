<?php

class ThuongHieu {
    public $math;
    public $tenth;
    public $madm;

    public function __construct($row) {
        $this->math = $row['math'];
        $this->tenth = $row['tenth'];
        $this->madm = $row['madm'];
    }
}