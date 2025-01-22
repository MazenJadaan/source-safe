<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Utils\FileUtility;

class GroupService
{
    protected $GroupRepository ;

    public function __construct(GroupRepository $GroupRepository)
    {
      $this->GroupRepository = $GroupRepository ;
    }

    public function getAllGroups(){
        return $this->GroupRepository->getAll();
    }

    public function getUserGroups($userId,$search = null, $perPage = 10){
        return $this->GroupRepository->getUserGroups($userId,$search,$perPage);
    }
    public function getGroupById($id){
        return $this->GroupRepository->findById($id);
    }
    /**
     * Create a group and associate users.
     *
     * @param array $data
     * @param int $creatorId
     * @return void
     */
    public function createGroup(array $data, $creatorId)
    {
        if (isset($data['image'])) {
            $data['image'] = FileUtility::storeFile($data['image'], 'group-images');
        }

        $group = $this->GroupRepository->create([
            'name' => $data['name'],
            'image' => isset($data['image']) ? $data['image'] : 'group-images/default-group.jpg',
        ]);

        $this->GroupRepository->attachUsers($group, isset($data['users']) ? $data['users'] : [], $creatorId);
    }
    public function updateGroup(array $data, $groupId)
    {
        // Retrieve the group object using its ID
        $group = $this->GroupRepository->findById($groupId);

        if (!$group) {
            throw new \Exception('Group not found');
        }

        // Handle image update
        if (isset($data['image'])) {
            $data['image'] = FileUtility::storeFile($data['image'], 'group-images');

            // Delete the old image
            if ($group->image && $group->image !== 'group-images/default-group.jpg') {
                FileUtility::deleteFile($group->image);
            }
        }

        return $this->GroupRepository->update($group->id, $data);
    }

    public function deleteGroup($id){
        return $this->GroupRepository->delete($id);
    }

    public function getGroupMembers($groupId)
    {
        return $this->GroupRepository->getGroupMembers($groupId);
    }
    public function getGroupFiles($groupId){
        return $this->GroupRepository->getGroupFiles($groupId);
    }
    public function getFilesOrders($groupId){
        return $this->GroupRepository->getFilesOrders($groupId);
    }

}
