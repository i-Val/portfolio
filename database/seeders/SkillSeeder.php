<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Seed technical skills with monochrome SVG icons.
     */
    public function run(): void
    {
        $skills = [
            ['title' => 'Laravel', 'code' => 'LV', 'percent' => 95, 'sort_order' => 1],
            ['title' => 'PHP', 'code' => 'PHP', 'percent' => 94, 'sort_order' => 2],
            ['title' => 'JavaScript', 'code' => 'JS', 'percent' => 92, 'sort_order' => 3],
            ['title' => 'TypeScript', 'code' => 'TS', 'percent' => 88, 'sort_order' => 4],
            ['title' => 'React', 'code' => 'RC', 'percent' => 87, 'sort_order' => 5],
            ['title' => 'Vue.js', 'code' => 'VUE', 'percent' => 86, 'sort_order' => 6],
            ['title' => 'Tailwind CSS', 'code' => 'TW', 'percent' => 91, 'sort_order' => 7],
            ['title' => 'MySQL', 'code' => 'SQL', 'percent' => 90, 'sort_order' => 8],
            ['title' => 'PostgreSQL', 'code' => 'PG', 'percent' => 85, 'sort_order' => 9],
            ['title' => 'Redis', 'code' => 'RDS', 'percent' => 83, 'sort_order' => 10],
            ['title' => 'Docker', 'code' => 'DCK', 'percent' => 84, 'sort_order' => 11],
            ['title' => 'REST & GraphQL', 'code' => 'API', 'percent' => 92, 'sort_order' => 12],
        ];

        foreach ($skills as $item) {
            $slug = Str::slug($item['title']);
            $iconPath = "uploads/skills/seeded-{$slug}.svg";
            Storage::disk('public')->put($iconPath, $this->makeBadgeSvg($item['code']));

            $existing = Skill::query()->where('title', $item['title'])->first();

            if ($existing) {
                $existing->update([
                    'icon' => $existing->icon ?: $iconPath,
                    'percent' => $existing->percent > 0 ? $existing->percent : $item['percent'],
                    'sort_order' => $existing->sort_order > 0 ? $existing->sort_order : $item['sort_order'],
                    'is_active' => true,
                ]);
            } else {
                Skill::create([
                    'title' => $item['title'],
                    'icon' => $iconPath,
                    'percent' => $item['percent'],
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]);
            }
        }
    }

    private function makeBadgeSvg(string $code): string
    {
        $fontSize = strlen($code) > 2 ? 15 : 18;
        $label = htmlspecialchars($code, ENT_XML1, 'UTF-8');

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
    <rect x="4" y="4" width="56" height="56" rx="12" fill="#141414" stroke="#ffffff" stroke-width="2"/>
    <text x="32" y="38" text-anchor="middle" fill="#ffffff" font-family="monospace" font-size="{$fontSize}" font-weight="700" letter-spacing="1">{$label}</text>
</svg>
SVG;
    }
}
