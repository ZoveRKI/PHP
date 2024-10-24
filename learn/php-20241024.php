<?php
$edges = [
    ['ancestor_id' => 1, 'descendant_id' => 1],
    ['ancestor_id' => 1, 'descendant_id' => 2],
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
];

$listB = [];
$listC = [];
$listA = [];

foreach ($edges as $edge) {
    $ancestorId = $edge['ancestor_id'];
    $descendantId = $edge['descendant_id'];

    if ($ancestorId !== $descendantId) {

        if (!in_array($ancestorId, $listB)) {
            $listB[] = $ancestorId;
        }

        if (!in_array($descendantId, $listC)) {
            $listC[] = $descendantId;
        }
    }
}

foreach ($listB as $bId) {
    if (in_array($bId, $listC)) {

        $listC = array_diff($listC, [$bId]);

        foreach ($edges as $edge) {
            if ($edge['descendant_id'] == $bId && $edge['descendant_id'] !== $edge['ancestor_id']) {
                if (!in_array($edge['ancestor_id'], $listA)) {
                    $listA[] = $edge['ancestor_id'];
                    $listB = array_diff($listB, [$edge['ancestor_id']]);
                }
            }
        }
    }
}

echo "List A: " . implode(", ", $listA) . "\n";
echo "List B: " . implode(", ", $listB) . "\n";
echo "List C: " . implode(", ", $listC) . "\n";
