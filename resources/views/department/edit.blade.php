<form action="{{ route('department.update', ['department' => $department->id]) }}" method="post">
    @csrf
    @method('PUT')

    <label for="schedule_from">Schedule From</label>
    <input type="time" name="schedule_from" id="schedule_from"
           value="{{ $department->schedule_from }}">

    <label for="schedule_to">Schedule To</label>
    <input type="time" name="schedule_to" id="schedule_to"
           value="{{ $department->schedule_to }}">

    <input type="submit" value="Update Schedule">
</form>

