<?php

namespace App\Http\Controllers;

use App\Application\Event\CreateEventUseCase;
use App\Application\Event\DeleteEventUseCase;
use App\Application\Event\GetAllEventsUseCase;
use App\Application\Event\GetOneEventUseCase;
use App\Application\Event\UpdateEventUseCase;
use App\Domain\Event\Event;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    public function __construct(
        private readonly CreateEventUseCase  $createEvent,
        private readonly UpdateEventUseCase  $updateEvent,
        private readonly DeleteEventUseCase  $deleteEvent,
        private readonly GetAllEventsUseCase $getAllEvents,
        private readonly GetOneEventUseCase  $getOneEvent
    )
    {
    }

    public function one(Event $event): JsonResponse
    {
        return response()->json(
            $this->getOneEvent->execute($event),
            Response::HTTP_OK
        );
    }

    public function create(CreateEventRequest $request): JsonResponse
    {
        return response()->json(
            $this->createEvent->execute($request->validated()),
            Response::HTTP_CREATED
        );
    }

    public function update(Event $event, UpdateEventRequest $request): JsonResponse
    {
        return response()->json(
            $this->updateEvent->execute($event, $request->validated()),
            Response::HTTP_OK
        );
    }

    public function all(Request $request): JsonResponse
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 10);
        $city = $request->get('city', null);

        return response()->json(
            $this->getAllEvents->execute($offset, $limit, $city),
            Response::HTTP_OK
        );
    }

    public function delete(Event $event): JsonResponse
    {
        $isDeleted = $this->deleteEvent->execute($event);

        return response()->json(
            ['status' => $isDeleted],
            $isDeleted
                ? Response::HTTP_ACCEPTED
                : Response::HTTP_EXPECTATION_FAILED
        );
    }
}
