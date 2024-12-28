public function lockTopic(int $id)
{
// Vérifie si un user est connecté
$user = \App\Session::getUser();
if (!$user) {
// Si l'utilisateur n'est pas connecté, redirige vers la liste des topics de la catégorie
$topicManager = new TopicManager();
$topic = $topicManager->findOneById($id);

if ($topic) {
$this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
}
return;
}

// Récup du topic
$topicManager = new TopicManager();
$topic = $topicManager->findOneById($id);

if ($topic) {
// Vérif si user = auteur
if ($topic->getUserId() !== $user->getId()) {
// Si user != auteur > liste des topics
$this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
return;
}

// Si user = auteur, change le statut du verrouillage
$newLockStatus = $topic->getLocked() ? 0 : 1;
$topicManager->updateLockStatus($id, $newLockStatus);

// Redirige vers la liste des topics de la catégorie
$this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
} else {

$this->redirectTo("home");
}
}