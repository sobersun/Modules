<?php

namespace App\Modules\Events\Observers;

use App\Modules\Events\Models\Event;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Model;


class EventObserver
{
    public function handle($event, $data)
    {
        if (is_array($data) && count($data) > 0) {

            $model = $data[0] ?? null;
            if ($model instanceof Model) {
                $modelClass = get_class($model);
                $reportableData = [];
                $eventName = $event;
                $sourceUrl = request()->url();
                $method = request()->method();
                /**
                 * TODO 
                 * Need to add tracing for the user who triggered events
                 */
                $reportableData = [
                    'method' => $method,
                    'url' => $sourceUrl,
                    'model_class' => $modelClass
                ];
                switch ($event) {
                    case 'eloquent.creating: ' . $modelClass:
                        break;

                    case 'eloquent.created: ' . $modelClass:
                        $reportableData['event'] = 'created';
                        $this->logEvent($model, $reportableData);
                        break;

                    case 'eloquent.updating: ' . $modelClass:
                        break;

                    case 'eloquent.updated: ' . $modelClass:
                        $reportableData['event'] = 'updated';
                        $this->logEvent($model, $reportableData);
                        break;

                    case 'eloquent.deleting: ' . $modelClass:
                        break;

                    case 'eloquent.deleted: ' . $modelClass:
                        $reportableData['event'] = 'deleted';
                        $this->logEvent($model, $reportableData);
                        break;

                    case 'eloquent.restoring: ' . $modelClass:
                        break;

                    case 'eloquent.restored: ' . $modelClass:
                        break;

                        // Add more cases for other events if needed

                    default:
                        // Handle other events as needed
                        break;
                }
            }
        }
    }

    protected function logEvent($model, $reportableData)
    {
        $reportableData['attribute_data'] = Json::encode($model->getAttributes());
        $eventModel = new Event;
        $eventModel->method = $reportableData['method'];
        $eventModel->url = $reportableData['url'];
        $eventModel->model_class = $reportableData['model_class'];
        $eventModel->event = $reportableData['event'];
        $eventModel->model_id = 1;
        $eventModel->attribute_data = $reportableData['attribute_data'];
        /**
         * PROBLEM:
         * Previously we used create but that lead us to an endless process of events getting 
         * triggered the solution is to use saveQuietly it doesnt trigger any events.
         */
        $eventModel->saveQuietly();
    }
}
