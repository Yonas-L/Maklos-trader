use Carbon\Carbon;
use App\Models\AboutContent;
use App\Models\AboutValue;
use App\Models\FaqItem;
use App\Models\HeroSlide;
use App\Models\ManufacturingStep;
use App\Models\ProductHighlight;

function safeCreate($class, $attrs) {
    $m = new $class();
    foreach ($attrs as $k => $v) {
        $m->$k = $v;
}
$m->save();
return $m;
}

$now = Carbon::now()->toDateTimeString();

$aboutContent = AboutContent::first();
if (!$aboutContent) {
$aboutContent = safeCreate(AboutContent::class, [
'experience_years' => 12,
'label' => 'About',
'headline' => 'We build quality products',
'description' => 'Sample about description. Replace with your content.',
'mission_title' => 'Our Mission',
'mission_description' => 'To deliver excellent products and service.',
'vision_title' => 'Our Vision',
'vision_description' => 'To lead the market responsibly.',
'values_title' => 'Our Values',
'values_description' => 'Integrity, Quality, Customer-first',
'created_at' => $now,
'updated_at' => $now,
]);
}

$aboutValues = [
[
'about_content_id' => $aboutContent->id,
'type' => 'overview',
'title' => 'Company Overview',
'badge' => null,
'summary' => null,
'details' => 'Maklos Trading is a premium soap manufacturer serving Africa and export markets. We design, manufacture, and supply bathing soaps that combine natural freshness with export-ready packaging and consistent quality.',
'accent_color' => null,
'is_active' => true,
'sort_order' => 1,
'created_at' => $now,
'updated_at' => $now,
],
[
'about_content_id' => $aboutContent->id,
'type' => 'mission',
'title' => 'Mission',
'badge' => null,
'summary' => null,
'details' => "To be Africa's trusted source of high-quality, affordable, and safe bathing soaps by combining modern manufacturing precision with natural ingredients and rigorous quality control.",
'accent_color' => null,
'is_active' => true,
'sort_order' => 2,
'created_at' => $now,
'updated_at' => $now,
],
[
'about_content_id' => $aboutContent->id,
'type' => 'vision',
'title' => 'Vision',
'badge' => null,
'summary' => null,
'details' => 'To lead the regional soap manufacturing industry through sustainable innovation, strong customer partnerships, and export excellence that meets international standards.',
'accent_color' => null,
'is_active' => true,
'sort_order' => 3,
'created_at' => $now,
'updated_at' => $now,
],
[
'about_content_id' => $aboutContent->id,
'type' => 'values',
'title' => 'Core Values',
'badge' => null,
'summary' => null,
'details' => 'Quality, Integrity, Innovation, Reliability, and Partnership guide our operations: tested batches, ethical sourcing, continuous product development, dependable supply, and flexible OEM solutions.',
'accent_color' => null,
'is_active' => true,
'sort_order' => 4,
'created_at' => $now,
'updated_at' => $now,
],
[
'about_content_id' => $aboutContent->id,
'type' => 'products',
'title' => 'Key Products & OEM',
'badge' => null,
'summary' => null,
'details' => 'Flagship lines include Future Eucalyptus and Flavo Bathing Soap (available in 80g, 180g, 220g). We offer turnkey OEM/white-label manufacturing with formulation, fragrance matching, packaging, and export documentation.',
'accent_color' => null,
'is_active' => true,
'sort_order' => 5,
'created_at' => $now,
'updated_at' => $now,
],
[
'about_content_id' => $aboutContent->id,
'type' => 'manufacturing',
'title' => 'Manufacturing Excellence',
'badge' => null,
'summary' => null,
'details' => 'Controlled formulation, molding, and curing deliver consistent bar hardness, moisture control, and fragrance stability. Production includes lot-coded flow-wrap packaging and batch sampling for traceability.',
'accent_color' => null,
'is_active' => true,
'sort_order' => 6,
'created_at' => $now,
'updated_at' => $now,
],
[
'about_content_id' => $aboutContent->id,
'type' => 'quality',
'title' => 'Quality & Compliance',
'badge' => null,
'summary' => null,
'details' => 'We perform pH, microbial, stability, and fragrance strength testing; provide MSDS and Certificates of Analysis; and support labeling (INCI, HS codes) to ensure export readiness and regulatory compliance.',
'accent_color' => null,
'is_active' => true,
'sort_order' => 7,
'created_at' => $now,
'updated_at' => $now,
],
];

foreach ($aboutValues as $av) {
    $exists = AboutValue::where('title', $av['title'])->where('about_content_id', $aboutContent->id)->first();
    if (!$exists) {
safeCreate(AboutValue::class, $av);
}
}

$faqs = [
['category' => 'Products', 'question' => 'What sizes and SKUs do you produce?', 'answer' => 'We manufacture multiple bar sizes — commonly 80g, 180g, and 220g — across our signature lines (Future Eucalyptus and Flavo). We also support custom sizes between 80g and 250g for OEM/white-label clients.', 'sort_order' => 1, 'is_active' => true],
['category' => 'OEM', 'question' => 'Do you offer OEM / white‑label manufacturing?', 'answer' => 'Yes — we provide turnkey OEM and white‑label services including formulation, fragrance matching, packaging design, compliance labeling, and export documentation to help partners launch private‑label soap brands.', 'sort_order' => 2, 'is_active' => true],
['category' => 'Quality', 'question' => 'What quality tests and documentation do you provide?', 'answer' => 'Each batch undergoes pH, microbial, and stability testing; we provide MSDS, Certificates of Analysis, and support labeling with INCI names and HS codes to ensure regulatory and export readiness.', 'sort_order' => 3, 'is_active' => true],
];

foreach ($faqs as $f) {
    $exists = FaqItem::where('question', $f['question'])->first();
    if (!$exists) {
safeCreate(FaqItem::class, array_merge($f, ['created_at' => $now, 'updated_at' => $now]));
}
}

$heroSlides = [
['title' => 'Future Eucalyptus Soap', 'caption' => 'Refreshing, antibacterial eucalyptus soap — natural freshness in every bar.', 'image_path' => 'images/heroes/future-eucalyptus.jpg', 'button_primary_label' => 'Shop Future', 'button_primary_url' => '/products/future-eucalyptus', 'is_active' => true, 'sort_order' => 1],
['title' => 'Flavo Family Soap', 'caption' => 'Rich lather and gentle care — ideal for everyday family use.', 'image_path' => 'images/heroes/flavo-family.jpg', 'button_primary_label' => 'Explore Flavo', 'button_primary_url' => '/products/flavo', 'is_active' => true, 'sort_order' => 2],
['title' => 'OEM & White-Label Production', 'caption' => 'Turnkey soap manufacturing: formulation, packaging, and export-ready documentation.', 'image_path' => 'images/heroes/oem-production.jpg', 'button_primary_label' => 'Partner With Us', 'button_primary_url' => '/oem', 'is_active' => true, 'sort_order' => 3],
];

foreach ($heroSlides as $hs) {
    $exists = HeroSlide::where('title', $hs['title'])->where('button_primary_url', $hs['button_primary_url'])->first();
    if (!$exists) {
safeCreate(HeroSlide::class, array_merge($hs, ['created_at' => $now, 'updated_at' => $now]));
}
}

$manufacturing = [
['step_number' => '1', 'badge' => 'Formulation', 'title' => 'Formulation & Sourcing', 'description' => 'We select high-grade soap bases and active ingredients, validate supplier quality, and develop precise formulations optimized for performance and stability.', 'features' => json_encode(['High-grade raw materials','Fragrance & color matching','Stability & pH optimization']), 'image_path' => 'images/steps/formulation.jpg', 'is_active' => true, 'sort_order' => 1],
['step_number' => '2', 'badge' => 'Molding', 'title' => 'Molding & Curing', 'description' => 'Controlled saponification, molding, and curing processes ensure consistent density, hardness, and long-lasting performance across production runs.', 'features' => json_encode(['Precision molding','Controlled curing times','Density & hardness control']), 'image_path' => 'images/steps/molding.jpg', 'is_active' => true, 'sort_order' => 2],
['step_number' => '3', 'badge' => 'Packaging', 'title' => 'Packaging & Quality Control', 'description' => 'Automated flow-wrap packaging, lot coding, and batch testing deliver traceability and export-ready presentation with strict QC at every stage.', 'features' => json_encode(['Moisture-sealed flow-wrap','Lot coding & traceability','Batch QA sampling']), 'image_path' => 'images/steps/packaging.jpg', 'is_active' => true, 'sort_order' => 3],
];

foreach ($manufacturing as $ms) {
    $exists = ManufacturingStep::where('title', $ms['title'])->first();
    if (!$exists) {
safeCreate(ManufacturingStep::class, array_merge($ms, ['created_at' => $now, 'updated_at' => $now]));
}
}

$productHighlights = [
['label' => 'Future', 'title' => 'Future Eucalyptus Soap', 'description' => 'Cool, antibacterial eucalyptus soap with a refreshing scent — ideal for daily use and export-ready packaging.', 'slug' => 'future-eucalyptus-soap', 'image_path' => 'images/products/future-eucalyptus.jpg', 'is_featured' => true, 'sort_order' => 1],
['label' => 'Flavo', 'title' => 'Flavo Bathing Soap', 'description' => 'Rich-lather family soap formulated for gentle cleansing and consistent bar hardness across production batches.', 'slug' => 'flavo-bathing-soap', 'image_path' => 'images/products/flavo.jpg', 'is_featured' => false, 'sort_order' => 2],
['label' => 'OEM', 'title' => 'OEM & White-Label Service', 'description' => 'Turnkey private-label manufacturing: formulation, fragrance matching, packaging design, and export documentation.', 'slug' => 'oem-white-label-service', 'image_path' => 'images/products/oem.jpg', 'is_featured' => false, 'sort_order' => 3],
];

foreach ($productHighlights as $ph) {
    $exists = ProductHighlight::where('slug', $ph['slug'])->first();
    if (!$exists) {
safeCreate(ProductHighlight::class, array_merge($ph, ['created_at' => $now, 'updated_at' => $now]));
}
}
