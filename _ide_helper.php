<?php
// Intelephense IDE Helper - suppress false positives
namespace {
    exit("This file should only be used to help your IDE understand Eloquent query builder");
}

namespace Illuminate\Database\Eloquent {
    class Builder {
        public function where($column, $operator = null, $value = null, $boolean = 'and') {}
        public function orderBy($column, $direction = 'asc') {}
        public function with($relations) {}
        public function update(array $values = []) {}
        public function max($column) {}
    }

    class Model {
        public function delete() {}
    }
}
