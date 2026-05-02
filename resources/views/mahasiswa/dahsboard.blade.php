<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
</div>
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 26 26">
    <path fill="currentColor"
        d="M10 .188A9.81 9.81 0 0 0 .187 10A9.81 9.81 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.82 1.82 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16" />
</svg>

<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
    <path fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        d="M12 9.867L8.186 6.053a1.5 1.5 0 0 0-1.061-.44M2.25 9.868l3.814-3.814c.293-.293.677-.44 1.061-.44m0 13.395V5.614m9.75-.124v13.394m4.875-4.253l-3.814 3.814c-.293.293-.677.44-1.061.44M12 14.63l3.814 3.814c.293.293.677.44 1.061.44" />
</svg>

    public function webJsonMahasiswa(KampusApiService $api)
    {
        $data = $api->getAllMahasiswa([
            'size' => 100,
            'page' => 1
        ]);

        return response()->json($data);
    }