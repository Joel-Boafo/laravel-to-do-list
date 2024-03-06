<?php

use App\Models\Task;

it('ensures the user can see the home page', function () {
    $response = $this->get(route('tasks.index'));

    $response->assertStatus(200);
    $response->assertSee('Todo List');
    $response->assertSee('Clear Completed');
});

it('ensures the user can create a task', function () {
    $response = $this->post(route('tasks.store'), [
        'description' => fake()->sentence(),
        'is_completed' => fake()->boolean(),
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('tasks.index'));
});

it('ensures the user can see the edit page', function () {
    $task = Task::factory()->create();

    $response = $this->get(route('tasks.edit', $task->id));
    $response->assertStatus(200);
    $response->assertSee('Edit Task');
    $response->assertSee($task->description);
    $response->assertSee('Back');
});

it('ensures the user can update a task', function () {
    $task = Task::factory()->create();

    $response = $this->put(route('tasks.update', $task->id), [
        'description' => fake()->sentence(),
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('tasks.index'));
});

it('ensures the user can complete a task', function () {
    $task = Task::factory()->create([
        'is_completed' => false,
    ]);

    $response = $this->post(route('tasks.complete', $task->id), [
        'is_completed' => true,
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('tasks.index'));
});

it('ensures the user can clear their completed task', function () {
    $task = Task::factory()->create([
        'description' => 'hi',
        'is_completed' => true,
    ]);

    $response = $this->post(route('tasks.clear-completed', $task->id), [
        'is_completed' => false,
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('tasks.index'));
});

it('ensures the user can delete a task', function () {
    $task = Task::factory()->create();

    $response = $this->delete(route('tasks.destroy', $task->id));

    $response->assertStatus(302);
    $response->assertRedirect(route('tasks.index'));
    $response->assertDontSee($task->description);
});
