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
    /**
     * Create a group and associate users.
     *
     * @param array $data
     * @param int $creatorId
     * @return void
     */
    public function createGroup(array $data, $creatorId)
    {
        // Handle group image upload
        if (isset($data['image'])) {
            $data['image'] = FileUtility::storeFile($data['image'], 'group-images');
        }

        // Create the group
        $group = $this->GroupRepository->create([
            'name' => $data['name'],
            'image' => isset($data['image']) ? $data['image'] : 'group-images/default-group.jpg',
        ]);

        // Attach users to the group
        $this->GroupRepository->attachUsers($group, isset($data['users']) ? $data['users'] : [], $creatorId);
    }

}
