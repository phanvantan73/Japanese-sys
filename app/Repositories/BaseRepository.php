<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
	/**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritDoc}
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function find(array $conditions, $columns = ['*'])
    {
        return $this->model->where($conditions)->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function first(array $conditions, $columns = ['*'])
    {
        return $this->model->where($conditions)->firstOrFail($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function findByField($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        return $this->model->whereIn($field, $values)->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function findWhereNotIn($field, array $values, $columns = ['*'])
    {
        return $this->model->whereNotIn($field, $values)->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function firstOrCreate(array $attributes, array $values = [])
    {
        return $this->model->firstOrCreate($attributes, $values);
    }

    /**
     * {@inheritDoc}
     */
    public function update(array $attributes, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);

        return $model->save();
    }

    /**
     * {@inheritDoc}
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        return $model->delete($id);
    }
}
