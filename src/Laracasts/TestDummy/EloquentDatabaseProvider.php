<?php namespace Laracasts\TestDummy;

use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentDatabaseProvider implements BuildableRepositoryInterface {

	/**
	 * For preparing test data, we'll turn off
	 * mass assignment protection and such.
	 */
	function __construct()
	{
	   Eloquent::unguard();
	}

	/**
	 * Build the entity with attributes.
	 *
	 * @param string $type
	 * @param array  $attributes
	 * @throws TestDummyException
	 * @return Eloquent
	 */
	public function build($type, array $attributes)
	{
		if ( ! class_exists($type))
		{
			throw new TestDummyException("The {$type} model was not found.");
		}

		return new $type($attributes);
	}

    /**
     * Save entity, then attach pivot entity
     *
     * @param $pivotEntity
     * @param $entity
     * @internal param $type
     * @return mixed
     */
    public function saveWithPivotEntity($entity, $pivotEntity)
    {
        $type = $pivotEntity['type'];
        $subEntity = $pivotEntity['entity'];

        $entity = $this->save($entity);

        $entity->$type()->save($subEntity);

        return $entity;
    }

	/**
	 * Persist the entity.
	 *
	 * @param Model $entity
	 * @return void
	 */
	public function save($entity)
	{
        $entity->save();

        return $entity;
	}

}