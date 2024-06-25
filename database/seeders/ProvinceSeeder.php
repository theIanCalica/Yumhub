<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['id' => '3340481a-59bc-40c6-971f-5086687cf4ac', 'region_id' => 'bc4cbf06-486e-414e-8231-77ff031bf189', 'provinceName' => 'Basilan', 'created_at' => now()],
            ['id' => '015e1895-8621-40c6-8f56-954dc1c4697a', 'region_id' => 'bc4cbf06-486e-414e-8231-77ff031bf189', 'provinceName' => 'Lanao Del Sur', 'created_at' => now()],
            ['id' => '1129fb58-6f0e-430d-8f8d-60f16d293dfa', 'region_id' => 'bc4cbf06-486e-414e-8231-77ff031bf189', 'provinceName' => 'Maguindanao', 'created_at' => now()],
            ['id' => '3a88859b-43c2-4aff-bde3-b99731155d72', 'region_id' => 'bc4cbf06-486e-414e-8231-77ff031bf189', 'provinceName' => 'Sulu', 'created_at' => now()],
            ['id' => '16710fd6-71d5-46a3-97de-392bd2ec0de9', 'region_id' => 'bc4cbf06-486e-414e-8231-77ff031bf189', 'provinceName' => 'Tawi-Tawi', 'created_at' => now()],
            ['id' => '72327800-bb59-4f7a-8f1f-2a9810b3da33', 'region_id' => 'b00ba139-2524-4470-8f37-e1d552e53d18', 'provinceName' => 'Abra', 'created_at' => now()],
            ['id' => 'e4a0c21b-e6a3-4d13-a904-a576ede2d89f', 'region_id' => 'b00ba139-2524-4470-8f37-e1d552e53d18', 'provinceName' => 'Apayao', 'created_at' => now()],
            ['id' => 'f3ab5351-8646-4d16-a17a-6880fdc2fa2d', 'region_id' => 'b00ba139-2524-4470-8f37-e1d552e53d18', 'provinceName' => 'Benguet', 'created_at' => now()],
            ['id' => '0cfe276b-847d-4f3f-86b4-978b4d11e14b', 'region_id' => 'b00ba139-2524-4470-8f37-e1d552e53d18', 'provinceName' => 'Ifugao', 'created_at' => now()],
            ['id' => 'ee8bc53c-c5c0-4c2f-a478-5b4db3325ed6', 'region_id' => 'b00ba139-2524-4470-8f37-e1d552e53d18', 'provinceName' => 'Kalinga', 'created_at' => now()],
            ['id' => 'ccb17d51-3832-4150-80fc-dd96886a7ec9', 'region_id' => 'b00ba139-2524-4470-8f37-e1d552e53d18', 'provinceName' => 'Mountain Province', 'created_at' => now()],
            ['id' => '7d492933-d9bb-4ee4-b96d-e965e0a02e80', 'region_id' => '1bd99789-36ec-4def-b099-5a289f8f0459', 'provinceName' => 'Ilocos Norte', 'created_at' => now()],
            ['id' => '68d635bd-e060-4a30-8883-5ca9eab7d84b', 'region_id' => '1bd99789-36ec-4def-b099-5a289f8f0459', 'provinceName' => 'Ilocos Sur', 'created_at' => now()],
            ['id' => 'dd353113-2ed0-4e37-adf1-521945b6443e', 'region_id' => '1bd99789-36ec-4def-b099-5a289f8f0459', 'provinceName' => 'La Union', 'created_at' => now()],
            ['id' => 'b4503dbd-d433-410c-8668-3a0911eb653c', 'region_id' => '1bd99789-36ec-4def-b099-5a289f8f0459', 'provinceName' => 'Pangasinan', 'created_at' => now()],
            ['id' => 'f748afe9-181b-46cd-aac8-000a37e06dba', 'region_id' => 'ed076277-2e4b-42bf-9f9e-6e54c57ab0bf', 'provinceName' => 'Batanes', 'created_at' => now()],
            ['id' => 'b8b6dd7c-37bf-4549-b2d5-7fcfb60125d1', 'region_id' => 'ed076277-2e4b-42bf-9f9e-6e54c57ab0bf', 'provinceName' => 'Cagayan', 'created_at' => now()],
            ['id' => '653500f8-5ad4-42b6-8b6e-fe4cb3c830d8', 'region_id' => 'ed076277-2e4b-42bf-9f9e-6e54c57ab0bf', 'provinceName' => 'Isabela', 'created_at' => now()],
            ['id' => 'f8fd6d67-85e4-4249-a5ec-92d46fcf42ce', 'region_id' => 'ed076277-2e4b-42bf-9f9e-6e54c57ab0bf', 'provinceName' => 'Nueva Vizcaya', 'created_at' => now()],
            ['id' => '2d472c1e-3c84-4272-b01f-664379e97741', 'region_id' => 'ed076277-2e4b-42bf-9f9e-6e54c57ab0bf', 'provinceName' => 'Quirino', 'created_at' => now()],
            ['id' => 'ec090f94-d3bf-44a4-8868-ca57d96ce9bc', 'region_id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'provinceName' => 'Aurora', 'created_at' => now()],
            ['id' => 'ccd1feee-0994-41bb-a132-d29ebcf6c757', 'region_id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'provinceName' => 'Bataan', 'created_at' => now()],
            ['id' => '7e3811e7-93f5-4db3-bbb5-ea55b6c4815d', 'region_id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'provinceName' => 'Bulacan', 'created_at' => now()],
            ['id' => 'f8784e44-da9b-46a6-98bc-fc93553254c3', 'region_id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'provinceName' => 'Nueva Ecija', 'created_at' => now()],
            ['id' => '01491b8d-b45d-4505-b890-c1c53521d17b', 'region_id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'provinceName' => 'Pampanga', 'created_at' => now()],
            ['id' => 'ac69bcc1-9ca7-4d1f-93f2-4e46196465b6', 'region_id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'provinceName' => 'Tarlac', 'created_at' => now()],
            ['id' => 'a4a1c3e2-7cb8-43f3-a491-15a204eace44', 'region_id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'provinceName' => 'Zambales', 'created_at' => now()],
            ['id' => '45dec108-a6bc-4044-9ca0-2c2db6331865', 'region_id' => '333cade5-5300-4b68-87a1-fa2945a9c5e9', 'provinceName' => 'Batangas', 'created_at' => now()],
            ['id' => '5096c35f-3515-4677-a3d4-43197c0e3165', 'region_id' => '333cade5-5300-4b68-87a1-fa2945a9c5e9', 'provinceName' => 'Cavite', 'created_at' => now()],
            ['id' => 'f02d7768-9fe2-4609-b205-4cf2522f901d', 'region_id' => '333cade5-5300-4b68-87a1-fa2945a9c5e9', 'provinceName' => 'Laguna', 'created_at' => now()],
            ['id' => '4289b21d-9806-42a1-a6e0-14c5dc8b4ac8', 'region_id' => '333cade5-5300-4b68-87a1-fa2945a9c5e9', 'provinceName' => 'Rizal', 'created_at' => now()],
            ['id' => 'a0ed5436-f9e4-4e18-9735-d8388f4481f1', 'region_id' => '333cade5-5300-4b68-87a1-fa2945a9c5e9', 'provinceName' => 'Quezon', 'created_at' => now()],
            ['id' => '8b259e55-2ac7-4323-94a8-9fdc162a774a', 'region_id' => '08340666-5e03-4956-a51c-d66210db0e1c', 'provinceName' => 'Albay', 'created_at' => now()],
            ['id' => 'e93646c6-085e-418b-b456-7e8f461e5fc3', 'region_id' => '08340666-5e03-4956-a51c-d66210db0e1c', 'provinceName' => 'Camarines Norte', 'created_at' => now()],
            ['id' => '9dbf8d66-335f-4c5e-aa87-224e4e9ecf86', 'region_id' => '08340666-5e03-4956-a51c-d66210db0e1c', 'provinceName' => 'Camarines Sur', 'created_at' => now()],
            ['id' => '476d45c3-bafd-458c-8886-a58978cb56d6', 'region_id' => '08340666-5e03-4956-a51c-d66210db0e1c', 'provinceName' => 'Catanduanes', 'created_at' => now()],
            ['id' => '1b9b3337-0a1e-4c8b-b552-9ec97fc0e838', 'region_id' => '08340666-5e03-4956-a51c-d66210db0e1c', 'provinceName' => 'Masbate', 'created_at' => now()],
            ['id' => '96e373c1-d9a6-452a-aeb7-f94e27ba861e', 'region_id' => '08340666-5e03-4956-a51c-d66210db0e1c', 'provinceName' => 'Sorsogon', 'created_at' => now()],
            ['id' => 'f14b08bc-69d9-44b4-a2cf-d0f996c603cf', 'region_id' => 'e8252541-bdca-4d9e-baab-d770d1fa9f72', 'provinceName' => 'Aklan', 'created_at' => now()],
            ['id' => 'd26bb9df-114f-4ae2-8ba8-4e0d7e010c66', 'region_id' => 'e8252541-bdca-4d9e-baab-d770d1fa9f72', 'provinceName' => 'Antique', 'created_at' => now()],
            ['id' => 'a656cbb9-cad1-4d39-a621-cec25c8e7014', 'region_id' => 'e8252541-bdca-4d9e-baab-d770d1fa9f72', 'provinceName' => 'Capiz', 'created_at' => now()],
            ['id' => '997a0175-11a2-4671-8b13-5b792f8e1c41', 'region_id' => 'e8252541-bdca-4d9e-baab-d770d1fa9f72', 'provinceName' => 'Guimaras', 'created_at' => now()],
            ['id' => 'a23555c8-d261-4bbf-b6af-0243262e683e', 'region_id' => 'e8252541-bdca-4d9e-baab-d770d1fa9f72', 'provinceName' => 'Iloilo', 'created_at' => now()],
            ['id' => 'a9f04607-5615-430a-805c-0b027b19f16a', 'region_id' => 'e8252541-bdca-4d9e-baab-d770d1fa9f72', 'provinceName' => 'Negros Occidental', 'created_at' => now()],
            ['id' => 'b72e1065-8cd7-457b-b9a2-0b6687fe5e9a', 'region_id' => 'e0b59acf-dbb5-4e35-af68-d39066ef6e06', 'provinceName' => 'Bohol', 'created_at' => now()],
            ['id' => '44c88b14-2d45-4372-9a8d-e495d2d38a3d', 'region_id' => 'e0b59acf-dbb5-4e35-af68-d39066ef6e06', 'provinceName' => 'Cebu', 'created_at' => now()],
            ['id' => '013b080c-93ae-4532-9f6a-9da4d915cd4e', 'region_id' => 'e0b59acf-dbb5-4e35-af68-d39066ef6e06', 'provinceName' => 'Negros Oriental', 'created_at' => now()],
            ['id' => 'e888e778-cdf0-4e86-8e00-71f361ee9ca9', 'region_id' => 'e0b59acf-dbb5-4e35-af68-d39066ef6e06', 'provinceName' => 'Siquijor', 'created_at' => now()],
            ['id' => 'c442bce1-6c80-42f9-b39a-482475d8e790', 'region_id' => '4f1d74ee-cb0a-4c21-91f7-4861d57c0f14', 'provinceName' => 'Biliran', 'created_at' => now()],
            ['id' => 'ab6cc7b8-a99f-4420-9db2-acea6c1d59ef', 'region_id' => '4f1d74ee-cb0a-4c21-91f7-4861d57c0f14', 'provinceName' => 'Eastern Samar', 'created_at' => now()],
            ['id' => '17afa05a-c412-45eb-9892-11268e62eae9', 'region_id' => '4f1d74ee-cb0a-4c21-91f7-4861d57c0f14', 'provinceName' => 'Leyte', 'created_at' => now()],
            ['id' => '89169087-1a25-4b1b-b2dd-c5f7ae4a3f7e', 'region_id' => '4f1d74ee-cb0a-4c21-91f7-4861d57c0f14', 'provinceName' => 'Northern Samar', 'created_at' => now()],
            ['id' => '20604af6-8a8d-4d38-ba73-57bdfb5234dd', 'region_id' => '4f1d74ee-cb0a-4c21-91f7-4861d57c0f14', 'provinceName' => 'Samar', 'created_at' => now()],
            ['id' => '7e8de013-addd-45c4-8f6e-83bd700cd437', 'region_id' => '4f1d74ee-cb0a-4c21-91f7-4861d57c0f14', 'provinceName' => 'Southern Leyte', 'created_at' => now()],
            ['id' => '90576c3a-9cbd-44d4-9a9f-4fc121707dbc', 'region_id' => 'bfb98162-8bf1-426b-bf09-a0db0eac4232', 'provinceName' => 'Zamboanga Sibugay', 'created_at' => now()],
            ['id' => '6e0003a4-1352-4ac9-a3c9-c55f5b5db83f', 'region_id' => 'bfb98162-8bf1-426b-bf09-a0db0eac4232', 'provinceName' => 'Zamboanga del Sur', 'created_at' => now()],
            ['id' => 'b2cbc9cc-6239-4a69-aa74-7692ea40cffd', 'region_id' => 'bfb98162-8bf1-426b-bf09-a0db0eac4232', 'provinceName' => 'Zamboanga del Norte', 'created_at' => now()],
            ['id' => '2e67099a-eac1-4f99-b331-c264ca581200', 'region_id' => '6193eddb-f871-4d9f-9a0a-c686f1f3adee', 'provinceName' => 'Bukidnon', 'created_at' => now()],
            ['id' => '912880d5-b15b-4512-91c6-c63a26bf64a0', 'region_id' => '6193eddb-f871-4d9f-9a0a-c686f1f3adee', 'provinceName' => 'Camiguin', 'created_at' => now()],
            ['id' => 'd918c342-8e78-4d3d-b54d-5aef59b4b064', 'region_id' => '6193eddb-f871-4d9f-9a0a-c686f1f3adee', 'provinceName' => 'Lanao del Norte', 'created_at' => now()],
            ['id' => '0236aa96-c3ec-4923-b13f-6fdc44f1b548', 'region_id' => '6193eddb-f871-4d9f-9a0a-c686f1f3adee', 'provinceName' => 'Misamis Occidental', 'created_at' => now()],
            ['id' => '68a6a2ee-fc61-4c83-ac23-f000465bd9a1', 'region_id' => '6193eddb-f871-4d9f-9a0a-c686f1f3adee', 'provinceName' => 'Misamis Oriental', 'created_at' => now()],
            ['id' => 'd36bbb3f-e542-4f42-ad2a-a179ecd57211', 'region_id' => '4693aae0-6a7a-46e5-9bfb-5b5e44579adf', 'provinceName' => 'Davao Occidental', 'created_at' => now()],
            ['id' => '3da9dbd1-142f-4d29-89ec-7f659aeb5c8d', 'region_id' => '4693aae0-6a7a-46e5-9bfb-5b5e44579adf', 'provinceName' => 'Davao Oriental', 'created_at' => now()],
            ['id' => '579bf94b-6c91-4a31-b991-477c77b5d317', 'region_id' => '4693aae0-6a7a-46e5-9bfb-5b5e44579adf', 'provinceName' => 'Davao de Oro', 'created_at' => now()],
            ['id' => '35f13b69-f85b-492d-ace7-6f5a61e5227f', 'region_id' => '4693aae0-6a7a-46e5-9bfb-5b5e44579adf', 'provinceName' => 'Davao del Norte', 'created_at' => now()],
            ['id' => 'ee8705ea-9db1-4c4a-bdd6-99d12a613819', 'region_id' => '4693aae0-6a7a-46e5-9bfb-5b5e44579adf', 'provinceName' => 'Davao del Sur', 'created_at' => now()],
            ['id' => '956b662a-0bb2-4b5b-8063-778cacb119c0', 'region_id' => 'ca3467d1-031e-43e7-a369-747787ae902a', 'provinceName' => 'Cotabato', 'created_at' => now()],
            ['id' => 'b8fc42f1-cf0f-444b-9388-219949c7636d', 'region_id' => 'ca3467d1-031e-43e7-a369-747787ae902a', 'provinceName' => 'Sarangani', 'created_at' => now()],
            ['id' => '1f6d263e-d291-4d2a-8524-f8f5731a4c87', 'region_id' => 'ca3467d1-031e-43e7-a369-747787ae902a', 'provinceName' => 'South Cotabato', 'created_at' => now()],
            ['id' => 'c897b544-97fd-4261-8bb6-26aa32a945c0', 'region_id' => 'ca3467d1-031e-43e7-a369-747787ae902a', 'provinceName' => 'Sultan Kudarat', 'created_at' => now()],
            ['id' => '43f09594-24be-41bd-9539-3330bb7ad914', 'region_id' => '1e96cf28-c453-4969-81c7-13c9ec46222a', 'provinceName' => 'Agusan del Norte', 'created_at' => now()],
            ['id' => '5bd255dd-3121-4f9d-818b-bf249c24f003', 'region_id' => '1e96cf28-c453-4969-81c7-13c9ec46222a', 'provinceName' => 'Agusan del Sur', 'created_at' => now()],
            ['id' => '8f494a6b-2a2f-42a3-aa97-20dd0b409552', 'region_id' => '1e96cf28-c453-4969-81c7-13c9ec46222a', 'provinceName' => 'Dinagat Islands', 'created_at' => now()],
            ['id' => '2088c3bf-06ce-4d12-97f3-67eed1b32a8d', 'region_id' => '1e96cf28-c453-4969-81c7-13c9ec46222a', 'provinceName' => 'Surigao del Norte', 'created_at' => now()],
            ['id' => '9976da60-eee8-440a-8527-35d9df907573', 'region_id' => '1e96cf28-c453-4969-81c7-13c9ec46222a', 'provinceName' => 'Surigao del Sur', 'created_at' => now()],
            ['id' => 'cb46141f-e0a2-4cfa-be11-29b967c56e9c', 'region_id' => '29394023-5fa0-4380-b69b-eec37947c79c', 'provinceName' => 'Metro Manila', 'created_at' => now()],
        ]);
    }
}
