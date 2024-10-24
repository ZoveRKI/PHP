<?php

/*
 * Version2
 */

$edges = [
    ['ancestor_id' => 11, 'descendant_id' => 11],
    ['ancestor_id' => 11, 'descendant_id' => 12],
    ['ancestor_id' => 12, 'descendant_id' => 12],
    ['ancestor_id' => 12, 'descendant_id' => 13],
    ['ancestor_id' => 12, 'descendant_id' => 14],
    ['ancestor_id' => 12, 'descendant_id' => 15],
    ['ancestor_id' => 11, 'descendant_id' => 13],
    ['ancestor_id' => 11, 'descendant_id' => 14],
    ['ancestor_id' => 11, 'descendant_id' => 15],
    ['ancestor_id' => 13, 'descendant_id' => 13],
    ['ancestor_id' => 14, 'descendant_id' => 14],
    ['ancestor_id' => 15, 'descendant_id' => 15],
    ['ancestor_id' => 15, 'descendant_id' => 16],
    ['ancestor_id' => 12, 'descendant_id' => 16],
    ['ancestor_id' => 11, 'descendant_id' => 16],
    ['ancestor_id' => 16, 'descendant_id' => 16],
];

// 初始化一个空的层级列表
$hierarchy = [];

// 查找每个节点的层级
function findLevel($edges, $nodeId, &$memo)
{
    // 如果已经计算过该节点的层级，直接返回
    if (isset($memo[$nodeId])) {
        return $memo[$nodeId];
    }

    // 默认层级为0（根节点）
    $maxLevel = 0;

    // 遍历所有的边，找到当前节点的所有祖先节点
    foreach ($edges as $edge) {
        if ($edge['descendant_id'] == $nodeId && $edge['ancestor_id'] != $nodeId) {
            // 递归查找祖先节点的层级
            $ancestorLevel = findLevel($edges, $edge['ancestor_id'], $memo);
            $maxLevel = max($maxLevel, $ancestorLevel + 1);
        }
    }

    // 记录该节点的层级
    $memo[$nodeId] = $maxLevel;
    return $maxLevel;
}

// 查找所有节点的层级并填充层级列表
$memo = [];
foreach ($edges as $edge) {
    $descendantId = $edge['descendant_id'];
    $level = findLevel($edges, $descendantId, $memo);

    // 将节点添加到对应的层级中
    if (!isset($hierarchy[$level])) {
        $hierarchy[$level] = [];
    }
    if (!in_array($descendantId, $hierarchy[$level])) {
        $hierarchy[$level][] = $descendantId;
    }
}

// 按层级打印结果
foreach ($hierarchy as $level => $nodes) {
    echo "Level $level: " . implode(", ", $nodes) . "\n";
}


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

