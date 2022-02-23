<?php

namespace App\Repositories;

use App\Models\RejectionHistory;
use App\Repositories\BaseRepository;
use App\Models\User;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version February 21, 2022, 7:20 pm UTC
*/

class RejectionHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'date',
        'comment'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RejectionHistory::class;
    }

    public function getRejectionHistory($user_id)
    {

      $rejectionHistory = User::with(['getRejectionHistory' => function($query)
      {
        $query->select('comment','date','user_id','id');
      }])->select('id','name')
      ->where('id', $user_id)
      ->get();
        $rejectionHistory = json_decode($rejectionHistory);
         

      return  $rejectionHistory;

    }

}
