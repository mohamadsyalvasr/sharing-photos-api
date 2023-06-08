<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\DestroyPhotoRequest;
use App\Http\Requests\Photo\StorePhotoRequest;
use App\Http\Requests\Photo\UpdatePhotoRequest;
use App\Http\Resources\PhotoCollection;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use App\Traits\FileHandlingTraits;

class PhotoController extends Controller
{
    use FileHandlingTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(): PhotoCollection
    {
        return new PhotoCollection(Photo::with(['user:id,name', 'tags'])->simplePaginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request): PhotoResource
    {
        $photo = auth()->user()->photos()->create($request->validated());
        $this->uploadFile($request, $photo, 'photo', 'photo');
        $photo->syncTags($request->validated('tag'));

        return $this->photoResponse($photo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo): PhotoResource
    {
        return $this->photoResponse($photo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo): PhotoResource
    {
        $photo->update($request->validated());
        $photo->syncTags($request->validated('tag'));
        return $this->photoResponse($photo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyPhotoRequest $request, Photo $photo): void
    {
        $this->deleteFile($photo->path);
        $photo->delete();
    }

    /**
     * @param Photo $photo
     * @return PhotoResource
     */
    public function like(Photo $photo): PhotoResource
    {
        $photo->likes()->attach(auth()->id());
        return $this->photoResponse($photo);
    }

    /**
     * @param Photo $photo
     * @return PhotoResource
     */
    public function unlike(Photo $photo): PhotoResource
    {
        $photo->likes()->detach(auth()->id());
        return $this->photoResponse($photo);
    }

    /**
     * @param Photo $photo
     * @return PhotoResource
     */
    protected function photoResponse(Photo $photo): PhotoResource
    {
        return new PhotoResource($photo->load('user', 'tags'));
    }
}
