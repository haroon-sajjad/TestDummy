<?php namespace Laracasts\TestDummy;

interface BuildableRepositoryInterface {

	/**
	 * Build the entity with attributes
	 *
	 * @param string $type
	 * @param array  $attributes
	 * @throws TestDummyException
	 * @return mixed
	 */
	public function build($type, array $attributes);

    /**
     * Persist the entity and attach pivot entity
     *
     * @param $entity
     * @internal param $type
     * @return mixed
     */
    public function saveWithPivotEntity($entity, $pivotEntity);

	/**
	 * Persist the entity
	 *
	 * @param $entity
	 * @return mixed
	 */
	public function save($entity);

} 