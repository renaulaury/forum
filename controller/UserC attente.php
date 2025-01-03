public function updateRole($id)
{
$id = $_POST['id'];
$newRole = $_POST['option'];

$updateUser = new UserManager;

if ($newRole === "Banni Temporairement") {
// Récup raison et précision du ban
$reasonBan = $_POST['banTemp'] ?? null;
$precisionBan = $_POST['raison'] ?? null;

if (empty($reasonBan) || empty($precisionBan)) {
Session::addFlash("error", "Pour un bannissement, tous les champs doivent être renseignés.");
$this->redirectTo("user", "listUsers");
return;
}

// Récup user pour maj dateEndBan
$user = $updateUser->findOneById($id);
$user->setDateEndBan(); // Maj dateEndBan dans bdd

// Now maj infos du ban
$updateUser->updateBanInfo($id, $reasonBan, $precisionBan); // Maj bdd

}
// else if ($newRole === "Banni Définitivement") {a gerer plus tard}

else { // Maj du role simplement
$role = $updateUser->updateRoleForUser($id, $newRole);
}

Session::addFlash("success", "Le role a bien été modifié");

$this->redirectTo("user", "listUsers");
exit();
}

--------------------------------
public function updateRole($id)
{
$id = $_POST['id'];
$newRole = $_POST['option'];

$updateUser = new UserManager;

if ($newRole === "Banni Temporairement") {
// Récup raison et précision du ban
$reasonBan = $_POST['banTemp'] ?? null;
$precisionBan = $_POST['raison'] ?? null;

if (empty($reasonBan) || empty($precisionBan)) {
Session::addFlash("error", "Pour un bannissement, tous les champs doivent être renseignés.");
$this->redirectTo("user", "listUsers");
return;
}

// Récup user pour maj dateEndBan
$user = $updateUser->findOneById($id);
$user->setDateEndBan(); // Maj dateEndBan dans bdd

// Now maj infos du ban
$updateUser->updateBanInfo($id, $reasonBan, $precisionBan); // Maj bdd

}
// else if ($newRole === "Banni Définitivement") {a gerer plus tard}

else { // Maj du role simplement
$role = $updateUser->updateRoleForUser($id, $newRole);
}

Session::addFlash("success", "Le role a bien été modifié");

$this->redirectTo("user", "listUsers");
exit();
}


Fonction qui fonctionne :

public function updateRole($id)
{
$id = $_POST['id'];
$newRole = $_POST['option'];

$updateUser = new UserManager;
$role = $updateUser->updateRoleForUser($id, $newRole);

Session::addFlash("success", "Le role a bien été modifié");

$this->redirectTo("user", "listUsers");
exit();
}

public function editProfile()
{
return [
"view" => VIEW_DIR . "user/editProfile.php",
"meta_description" => "Edition du profil d'un membre"
];
}