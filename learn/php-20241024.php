<?php

/*
 * Version5
 */

$edges = [
    ['ancestor_id' => 1, 'descendant_id' => 1],
    ['ancestor_id' => 1, 'descendant_id' => 2],
    ['ancestor_id' => 1, 'descendant_id' => 6],
    ['ancestor_id' => 1, 'descendant_id' => 10],
    ['ancestor_id' => 2, 'descendant_id' => 2],
    ['ancestor_id' => 2, 'descendant_id' => 3],
    ['ancestor_id' => 2, 'descendant_id' => 4],
    ['ancestor_id' => 2, 'descendant_id' => 5],
    ['ancestor_id' => 1, 'descendant_id' => 3],
    ['ancestor_id' => 1, 'descendant_id' => 4],
    ['ancestor_id' => 1, 'descendant_id' => 5],
    ['ancestor_id' => 3, 'descendant_id' => 3],
    ['ancestor_id' => 4, 'descendant_id' => 4],
    ['ancestor_id' => 5, 'descendant_id' => 5],
    ['ancestor_id' => 6, 'descendant_id' => 7],
    ['ancestor_id' => 6, 'descendant_id' => 8],
    ['ancestor_id' => 6, 'descendant_id' => 9],
    ['ancestor_id' => 10, 'descendant_id' => 11],
    ['ancestor_id' => 10, 'descendant_id' => 12],
    ['ancestor_id' => 10, 'descendant_id' => 13],
    ['ancestor_id' => 13, 'descendant_id' => 14],

    ['ancestor_id' => 21, 'descendant_id' => 21],
    ['ancestor_id' => 21, 'descendant_id' => 22],
    ['ancestor_id' => 22, 'descendant_id' => 22],
    ['ancestor_id' => 22, 'descendant_id' => 23],
    ['ancestor_id' => 22, 'descendant_id' => 24],
    ['ancestor_id' => 21, 'descendant_id' => 23],
    ['ancestor_id' => 21, 'descendant_id' => 24],
    ['ancestor_id' => 22, 'descendant_id' => 25],
    ['ancestor_id' => 21, 'descendant_id' => 25],
    ['ancestor_id' => 23, 'descendant_id' => 23],
    ['ancestor_id' => 24, 'descendant_id' => 24],
    ['ancestor_id' => 25, 'descendant_id' => 25],
    ['ancestor_id' => 25, 'descendant_id' => 26],
    ['ancestor_id' => 22, 'descendant_id' => 26],
    ['ancestor_id' => 21, 'descendant_id' => 26],
    ['ancestor_id' => 26, 'descendant_id' => 26],
];

$infomation = [
    ['organization_node_id' => 1, 'name' => '事業部1', 'organization_code' => 'ORG001'],
    ['organization_node_id' => 2, 'name' => 'groupA', 'organization_code' => '6a3b843a-8423-42f1-8145-f70c946501c0'],
    ['organization_node_id' => 6, 'name' => 'groupB', 'organization_code' => '00fc2d2a-dbe1-4fa0-9685-742af313db9f'],
    ['organization_node_id' => 10, 'name' => 'groupC', 'organization_code' => '15f7128d-803f-4b40-9fdf-1ca01478e73d'],
    ['organization_node_id' => 3, 'name' => 'teamA', 'organization_code' => '15f712f-1ca01478e73d'],
    ['organization_node_id' => 4, 'name' => 'teamB', 'organization_code' => '40-9fdf-1ca01478e73d'],
    ['organization_node_id' => 5, 'name' => 'teamC', 'organization_code' => 'b40-9fdf-1ca01478e73d'],
    ['organization_node_id' => 7, 'name' => 'teamA', 'organization_code' => '15f712f-1ca01478e73d'],
    ['organization_node_id' => 8, 'name' => 'teamB', 'organization_code' => '40-9fdf-1ca01478e73d'],
    ['organization_node_id' => 9, 'name' => 'teamC', 'organization_code' => 'b40-9fdf-1ca01478e73d'],
    ['organization_node_id' => 11, 'name' => 'teamD', 'organization_code' => '15f71a014d'],
    ['organization_node_id' => 12, 'name' => 'teamE', 'organization_code' => '40-91ca01478e73d'],
    ['organization_node_id' => 13, 'name' => 'teamF', 'organization_code' => 'b40-9fdf73d'],
    ['organization_node_id' => 14, 'name' => 'hahaxxx', 'organization_code' => 'b4d'],

    ['organization_node_id' => 21, 'name' => '事業部2', 'organization_code' => 'ORG002'],
    ['organization_node_id' => 22, 'name' => 'groupD', 'organization_code' => 'e24e058f-f273-4b38-bc66-554db9327711'],
    ['organization_node_id' => 23, 'name' => 'teamG', 'organization_code' => 'e24e058f'],
    ['organization_node_id' => 24, 'name' => 'teamH', 'organization_code' => '154045b6-f0dd-4b31-b6e2-60cefbd657b5'],
    ['organization_node_id' => 25, 'name' => 'teamI', 'organization_code' => '1540efbd657b5'],
    ['organization_node_id' => 26, 'name' => 'tttxxsst', 'organization_code' => '1540eb5'],
];

// 階層リストの初期化
$hierarchy = [];

// 各ノードの階層を判別
function findLevel($edges, $nodeId, &$memo)
{
    // 計算したことあるなら、直接返す
    if (isset($memo[$nodeId])) {
        return $memo[$nodeId];
    }

    // 一番最初のLevel
    $maxLevel = 0;

    // フルスキャンして、今のノードのすべての祖先ノードを探す
    foreach ($edges as $edge) {
        if ($edge['descendant_id'] == $nodeId && $edge['ancestor_id'] != $nodeId) {
            // 祖先ノードのレベルを再帰的に検索します
            $ancestorLevel = findLevel($edges, $edge['ancestor_id'], $memo);
            $maxLevel = max($maxLevel, $ancestorLevel + 1);
        }
    }

    // メモする
    $memo[$nodeId] = $maxLevel;
    return $maxLevel;
}

// 階層関係の構築
function buildHierarchy($edges, $nodeId, $currentLevel, &$memo)
{
    $children = [];
    foreach ($edges as $edge) {
        if ($edge['ancestor_id'] == $nodeId && $edge['descendant_id'] != $nodeId) {
            // 差が一階層のものだけやり取りする
            $descendantId = $edge['descendant_id'];
            if (isset($memo[$descendantId]) && $memo[$descendantId] == $currentLevel + 1) {
                $children[] = [
                    'node_id' => $descendantId,
                    'children' => buildHierarchy($edges, $descendantId, $currentLevel + 1, $memo)
                ];
            }
        }
    }
    return $children;
}

// 全てのノードの階層を探して、階層リストを充填する
$memo = [];
foreach ($edges as $edge) {
    $descendantId = $edge['descendant_id'];
    $level = findLevel($edges, $descendantId, $memo);

    // 該当ノードを該当階層に入れる
    if (!isset($hierarchy[$level])) {
        $hierarchy[$level] = [];
    }
    if (!in_array($descendantId, $hierarchy[$level])) {
        $hierarchy[$level][] = $descendantId;
    }
}

$tree = [];
foreach ($hierarchy[0] as $topNode) {
    $tree[] = [
        'node_id' => $topNode,
        'children' => buildHierarchy($edges, $topNode, 0, $memo)
    ];
}

print_r($hierarchy);

// foreach ($hierarchy as $level => $nodes) {
//     echo "Level $level: " . implode(", ", $nodes) . "\n";
// }

// print_r($tree);

function getGroupAndTeamInfo($tree, $informations)
{
    // 将节点信息按 ID 映射，便于查找
    $nodeInformation = [];
    foreach ($informations as $information) {
        $nodeInformation[$information['organization_node_id']] = [
            'name' => $information['name'],
            'organization_code' => $information['organization_code']
        ];
    }

    // 递归构建 groupMaster 数据
    function buildGroupMaster($nodes, $nodeInformation)
    {
        $result = [];
        foreach ($nodes as $node) {
            // 检查当前节点是否为 group
            if (isset($nodeInformation[$node['node_id']]) && strpos($nodeInformation[$node['node_id']]['name'], 'group') !== false) {
                $group = [
                    'groupID' => $node['node_id'],
                    'name' => $nodeInformation[$node['node_id']]['name'],
                    'organization_code' => $nodeInformation[$node['node_id']]['organization_code'],
                    'teamMaster' => []
                ];

                // 遍历并收集 team 层级的信息
                foreach ($node['children'] as $child) {
                    if (isset($nodeInformation[$child['node_id']]) && strpos($nodeInformation[$child['node_id']]['name'], 'team') !== false) {
                        $group['teamMaster'][] = [
                            'teamID' => $child['node_id'],
                            'name' => $nodeInformation[$child['node_id']]['name'],
                            'organization_code' => $nodeInformation[$child['node_id']]['organization_code']
                        ];
                    }
                }
                $result[] = $group;
            } else {
                // 递归处理更深层的 group
                $result = array_merge($result, buildGroupMaster($node['children'], $nodeInformation));
            }
        }
        return $result;
    }

    return ['groupMaster' => buildGroupMaster($tree, $nodeInformation)];
}

$groupAndTeamInfo = getGroupAndTeamInfo($tree, $infomation);
print_r($groupAndTeamInfo);

// /*
//  * Version2
//  */

// $edges = [
//     ['ancestor_id' => 1, 'descendant_id' => 1],
//     ['ancestor_id' => 1, 'descendant_id' => 2],
//     ['ancestor_id' => 2, 'descendant_id' => 2],
//     ['ancestor_id' => 2, 'descendant_id' => 3],
//     ['ancestor_id' => 2, 'descendant_id' => 4],
//     ['ancestor_id' => 2, 'descendant_id' => 5],
//     ['ancestor_id' => 1, 'descendant_id' => 3],
//     ['ancestor_id' => 1, 'descendant_id' => 4],
//     ['ancestor_id' => 1, 'descendant_id' => 5],
//     ['ancestor_id' => 3, 'descendant_id' => 3],
//     ['ancestor_id' => 4, 'descendant_id' => 4],
//     ['ancestor_id' => 5, 'descendant_id' => 5],

//     ['ancestor_id' => 11, 'descendant_id' => 11],
//     ['ancestor_id' => 11, 'descendant_id' => 12],
//     ['ancestor_id' => 12, 'descendant_id' => 12],
//     ['ancestor_id' => 12, 'descendant_id' => 13],
//     ['ancestor_id' => 12, 'descendant_id' => 14],
//     ['ancestor_id' => 12, 'descendant_id' => 15],
//     ['ancestor_id' => 11, 'descendant_id' => 13],
//     ['ancestor_id' => 11, 'descendant_id' => 14],
//     ['ancestor_id' => 11, 'descendant_id' => 15],
//     ['ancestor_id' => 13, 'descendant_id' => 13],
//     ['ancestor_id' => 14, 'descendant_id' => 14],
//     ['ancestor_id' => 15, 'descendant_id' => 15],
//     ['ancestor_id' => 15, 'descendant_id' => 16],
//     ['ancestor_id' => 12, 'descendant_id' => 16],
//     ['ancestor_id' => 11, 'descendant_id' => 16],
//     ['ancestor_id' => 16, 'descendant_id' => 16],
// ];

// // 階層リストの初期化
// // 初始化一个空的层级列表
// $hierarchy = [];

// // 各ノードの階層を判別
// // 查找每个节点的层级
// function findLevel($edges, $nodeId, &$memo)
// {
//     // 計算したことあるなら、直接返す
//     // 如果已经计算过该节点的层级，直接返回
//     if (isset($memo[$nodeId])) {
//         return $memo[$nodeId];
//     }

//     // 一番最初のLevel
//     // 默认层级为0（根节点）
//     $maxLevel = 0;

//     // フルスキャンして、今のノードのすべての祖先ノードを探す
//     // 遍历所有的边，找到当前节点的所有祖先节点
//     foreach ($edges as $edge) {
//         if ($edge['descendant_id'] == $nodeId && $edge['ancestor_id'] != $nodeId) {
//             // 递归查找祖先节点的层级
//             $ancestorLevel = findLevel($edges, $edge['ancestor_id'], $memo);
//             $maxLevel = max($maxLevel, $ancestorLevel + 1);
//         }
//     }

//     // メモする
//     // 记录该节点的层级
//     $memo[$nodeId] = $maxLevel;
//     return $maxLevel;
// }

// // 全てのノードの階層を探して、階層リストを充填する
// // 查找所有节点的层级并填充层级列表
// $memo = [];
// foreach ($edges as $edge) {
//     $descendantId = $edge['descendant_id'];
//     $level = findLevel($edges, $descendantId, $memo);

//     // 該当ノードを該当階層に入れる
//     // 将节点添加到对应的层级中
//     if (!isset($hierarchy[$level])) {
//         $hierarchy[$level] = [];
//     }
//     if (!in_array($descendantId, $hierarchy[$level])) {
//         $hierarchy[$level][] = $descendantId;
//     }
// }

// // print_r($hierarchy);

// foreach ($hierarchy as $level => $nodes) {
//     echo "Level $level: " . implode(", ", $nodes) . "\n";
// }


/*
 * Version1
 */
// $edges = [
//     ['ancestor_id' => 1, 'descendant_id' => 1],
//     ['ancestor_id' => 1, 'descendant_id' => 2],
//     ['ancestor_id' => 2, 'descendant_id' => 2],
//     ['ancestor_id' => 2, 'descendant_id' => 3],
//     ['ancestor_id' => 2, 'descendant_id' => 4],
//     ['ancestor_id' => 2, 'descendant_id' => 5],
//     ['ancestor_id' => 1, 'descendant_id' => 3],
//     ['ancestor_id' => 1, 'descendant_id' => 4],
//     ['ancestor_id' => 1, 'descendant_id' => 5],
//     ['ancestor_id' => 3, 'descendant_id' => 3],
//     ['ancestor_id' => 4, 'descendant_id' => 4],
//     ['ancestor_id' => 5, 'descendant_id' => 5],
// ];

// $listB = [];
// $listC = [];
// $listA = [];

// foreach ($edges as $edge) {
//     $ancestorId = $edge['ancestor_id'];
//     $descendantId = $edge['descendant_id'];

//     if ($ancestorId !== $descendantId) {

//         if (!in_array($ancestorId, $listB)) {
//             $listB[] = $ancestorId;
//         }

//         if (!in_array($descendantId, $listC)) {
//             $listC[] = $descendantId;
//         }
//     }
// }

// foreach ($listB as $bId) {
//     if (in_array($bId, $listC)) {

//         $listC = array_diff($listC, [$bId]);

//         foreach ($edges as $edge) {
//             if ($edge['descendant_id'] == $bId && $edge['descendant_id'] !== $edge['ancestor_id']) {
//                 if (!in_array($edge['ancestor_id'], $listA)) {
//                     $listA[] = $edge['ancestor_id'];
//                     $listB = array_diff($listB, [$edge['ancestor_id']]);
//                 }
//             }
//         }
//     }
// }

// echo "List A: " . implode(", ", $listA) . "\n";
// echo "List B: " . implode(", ", $listB) . "\n";
// echo "List C: " . implode(", ", $listC) . "\n";

