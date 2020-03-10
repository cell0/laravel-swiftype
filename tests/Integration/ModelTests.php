<?php

namespace Loonpwn\Swiftype\Tests\Integration;

use Loonpwn\Swiftype\Tests\App\Models\User;
use Loonpwn\Swiftype\Tests\BaseTestCase;

class ModelTests extends BaseTestCase
{
    /**
     * @test
     */
    public function deletes_model_on_delete()
    {
        // create a user, will trigger it to exist in Swiftype
        /** @var User $user */
        $user = factory(User::class)->create();

        $documents = $this->engine->listDocuments();

        $this->assertEquals($user->getKey(), $documents['results'][0]['id']);

        // delete the user
        $user->delete();

        $documents = $this->engine->listDocuments();

        $this->assertEmpty($documents['results']);
    }

    /**
     * @test
     */
    public function deletes_document_when_should_sync_becomes_false()
    {
        $user = factory(User::class)->create();

        $documents = $this->engine->listDocuments();

        $this->assertEquals($user->getKey(), $documents['results'][0]['id']);

        // User is set to NOT sync when name equals 'Do not sync'
        $user->name = 'Do not sync';
        $user->save();

        $documents = $this->engine->listDocuments();

        $this->assertEmpty($documents['results']);
    }
}
