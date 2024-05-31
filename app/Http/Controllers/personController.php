public function getPersonDetails(int $id)
{
    $person = Person::findOrFail($id);

    return response()->json($person);
}
public function getTrendingPeople(?int $limit = null, string $window = 'day')
{
    $people = Person::trending($limit, $window);

    return response()->json($people);
}
public function updatePersonDetails(int $id)
{
    $person = Person::findOrFail($id);

    if ($person->updateFromTmdb()) {
        return response()->json(['message' => 'Person details updated successfully']);
    } else {
        return response()->json(['error' => 'Failed to update person details'], 500);
    }
}
