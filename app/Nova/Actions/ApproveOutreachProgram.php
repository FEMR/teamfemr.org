<?php

namespace FEMR\Nova\Actions;

use FEMR\Data\Repositories\OutreachProgramRepository;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveOutreachProgram extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var OutreachProgramRepository $repository
     */
    private $repository;

    /**
     * @param OutreachProgramRepository $repository
     */
    public function __construct(OutreachProgramRepository $repository){

        $this->repository = $repository;
    }


    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $user_id = auth()->user()->id;
        foreach($models as $model){

            $this->repository->approve($model, $user_id);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
