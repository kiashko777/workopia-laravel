<x-layout>
    <x-slot name="title">Create new job</x-slot>
    <h1>Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Job Title">
        <input type="text" name="description" placeholder="Job description">
        <button type="submit">Submit</button>
    </form>
</x-layout>

