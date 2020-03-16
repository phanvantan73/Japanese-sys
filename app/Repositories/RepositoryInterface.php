<?php

namespace App\Repositories;

interface RepositoryInterface 
{
	/**
     * Retrieve all records.
     *
     * @param  array  $columns
     *
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * Find all records by the given conditions.
     *
     * @param  array  $conditions
     * @param  array  $columns
     *
     * @return mixed
     */
    public function find(array $conditions, $columns = ['*']);

    /**
     * Find a first record that match the given conditions.
     *
     * @param  array  $conditions
     * @param  array  $columns
     *
     * @return mixed
     */
    public function first(array $conditions, $columns = ['*']);

    /**
     * Find all records by the field and the value.
     *
     * @param  string  $field
     * @param  mixed  $value
     * @param  array  $columns
     *
     * @return mixed
     */
    public function findByField($field, $value, $columns = ['*']);

    /**
     * Find all records by multiple values in one field.
     *
     * @param  mixed  $field
     * @param  array  $values
     * @param  array  $columns
     *
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*']);

    /**
     * Find all records by excluding multiple values in one field.
     *
     * @param  mixed  $field
     * @param  array  $values
     * @param  array  $columns
     *
     * @return mixed
     */
    public function findWhereNotIn($field, array $values, $columns = ['*']);

    /**
     * Create a new entity.
     *
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Find or Create an entity.
     *
     * @param  array  $attributes
     * @param  array  $values
     *
     * @return mixed
     */
    public function firstOrCreate(array $attributes, array $values = []);

    /**
     * Update an entity by id.
     *
     * @param  array  $attributes
     * @param  mixed  $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id);

    /**
     * Update or Create an entity.
     *
     * @param  array  $attributes
     * @param  array  $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * Delete an entity by id.
     *
     * @param  mixed  $id
     *
     * @return int
     */
    public function delete($id);
}