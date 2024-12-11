<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Customer;

/**
 * Class CustomerService
 * @package App\Services
 */
class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    protected $model;
    public function __construct(Customer $model){
        $this->model=$model;
    }
}
