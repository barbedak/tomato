<?php

namespace App\Models\Traits;

use App\Exceptions\LogException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Log;
use Monolog\Formatter\LineFormatter;
use Str;

trait HasLog
{
    public function log(): MorphOne
    {
        return $this->morphOne(Log::class, 'logable');
    }

    protected static function bootHasLog()
    {
        static::created(function ($model) {
            $attr = json_encode($model->attributesToArray());
            $message = "Create object {$attr}";
            $model->writeToLog($model, 'created', $message);
        });

        static::updated(function ($model) {
            $attr = json_encode($model->attributesToArray());
            $message = "Update object attributes = {$attr}";
            $model->writeToLog($model, 'updated', $message);
        });

        static::deleted(function ($model) {
            $id = $model->id;
            $message = "Delete object with id = {$id}";
            $model->writeToLog($model, 'deleted', $message);
        });

        static::retrieved(function ($model) {
            $id = $model->id;
            $message = "Read object with id = {$id}";
            $model->writeToLog($model, 'read', $message);
        });
    }

    protected static function writeToLog(Model $model, string $event, string $message): void
    {
        $modelName = strtolower(class_basename($model));
        $modelPluralName = Str::plural($modelName);

        try {
            LogException::startLogging("Start Logging {$event} {$modelName}");
        } catch (LogException $e) {
            $e->report();
        }

        $logger = Log::build([
            'path' => storage_path("logs/{$modelPluralName}/{$event}.log"),
            'driver' => 'single',
            'replace_placeholders' => true,
        ]);

        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                '%message%' . PHP_EOL
            ));
        }

        $logger->info($message);

        try {
            LogException::endLogging("End Logging {$event} {$modelName}");
        } catch (LogException $e) {
            $e->report();
        }
    }
}
