public function deleteProfile()
{
$userManager = new UserManager;
$id = $_SESSION['user']->getId();
$userManager->delete($id);
$_SESSION['id']->logout();

$this->redirectTo("security", "register");
exit();
}