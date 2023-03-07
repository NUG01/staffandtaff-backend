<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryCriteria;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            //
        ];
    }

    public function createCategories()
    {
        $restaurant_sub_1 = Subcategory::create([
            'name' => 'Direction/Gérance',
            'slug' => 'direction_gerance',
        ]);

        $restaurant_sub_2 = Subcategory::create([
            'name' => 'Manager',
            'slug' => 'manager',
        ]);

        $restaurant_sub_3 = Subcategory::create([
            'name' => 'Barman/Barmaid/Mixologue',
            'slug' => 'barman_Barmaid_mixologue',
        ]);

        $restaurant_sub_4 = Subcategory::create([
            'name' => 'Apprenti',
            'slug' => 'apprenti',
        ]);

        $restaurant_sub_5 = Subcategory::create([
            'name' => 'Autre',
            'slug' => 'autre',
        ]);

        $restaurant_sub_6 = Subcategory::create([
            'name' => 'Administratif',
            'slug' => 'administratif',
        ]);

        $restaurant_sub_7 = Subcategory::create([
            'name' => "Hôte/Hôtesse d'accueil",
            'slug' => "hote_hotesse_daccueil",
        ]);
//
        $restaurant_sub_8 = Subcategory::create([
            'name' => 'Voiturier',
            'slug' => 'voiturier',
        ]);

        $restaurant_sub_9 = Subcategory::create([
            'name' => 'Chef de rang',
            'slug' => 'chef_de_rang',
        ]);

        $restaurant_sub_10 = Subcategory::create([
            'name' => "Maître d’hôtel",
            'slug' => "maitre_d_hotel",
        ]);

        $restaurant_sub_11 = Subcategory::create([
            'name' => 'Chef exécutif',
            'slug' => 'chef_executif',
        ]);

        $restaurant_sub_12 = Subcategory::create([
            'name' => 'Chef de cuisine',
            'slug' => 'chef_de_cuisine',
        ]);

        $restaurant_sub_13 = Subcategory::create([
            'name' => 'Second de cuisine',
            'slug' => 'second_de_cuisine',
        ]);

        $restaurant_sub_14 = Subcategory::create([
            'name' => 'Chef de partie',
            'slug' => 'chef_de_partie',
        ]);

        $restaurant_sub_15 = Subcategory::create([
            'name' => 'Commis',
            'slug' => 'commis',
        ]);

        $restaurant_sub_16 = Subcategory::create([
            'name' => 'Cuisinier',
            'slug' => 'cuisinier',
        ]);

        $restaurant_sub_17 = Subcategory::create([
            'name' => 'Aide cuisinier',
            'slug' => 'aide_cuisinier',
        ]);

        $restaurant_sub_18 = Subcategory::create([
            'name' => 'Chef pâtissier',
            'slug' => 'chef_patissier',
        ]);

        $restaurant_sub_19 = Subcategory::create([
            'name' => 'Second pâtissier',
            'slug' => 'second_patissier',
        ]);

        $restaurant_sub_20 = Subcategory::create([
            'name' => 'Chef de partie pâtisserie',
            'slug' => 'chef_de_partie_patisserie',
        ]);

        $restaurant_sub_21 = Subcategory::create([
            'name' => 'Commis pâtissier',
            'slug' => 'commis_patissier',
        ]);

        $restaurant_sub_22 = Subcategory::create([
            'name' => 'Chef Sommelier',
            'slug' => 'chef_sommelier',
        ]);

        $restaurant_sub_23 = Subcategory::create([
            'name' => 'Sommelier',
            'slug' => 'sommelier',
        ]);

        $restaurant_sub_24 = Subcategory::create([
            'name' => 'Casserolier',
            'slug' => 'casserolier',
        ]);

        $restaurant_sub_25 = Subcategory::create([
            'name' => 'Plongeur',
            'slug' => 'plongeur',
        ]);

        $restaurant_sub_26 = Subcategory::create([
            'name' => 'Serveur',
            'slug' => 'serveur',
        ]);

        $restaurant_sub_27 = Subcategory::create([
            'name' => 'Runner',
            'slug' => 'runner',
        ]);

        $hotel_sub_1 = Subcategory::create([
            'name' => 'Réceptionniste',
            'slug' => 'receptionniste',
        ]);


        $hotel_sub_2 = Subcategory::create([
            'name' => 'Conciergerie',
            'slug' => 'conciergerie',
        ]);

        $hotel_sub_3 = Subcategory::create([
            'name' => 'Veilleur de nuit',
            'slug' => 'veilleur_de_nuit',
        ]);

        $hotel_sub_4 = Subcategory::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
        ]);

        $hotel_sub_5 = Subcategory::create([
            'name' => 'Femme de chambre/Agent de style',
            'slug' => 'femme_de_chambre_agent_de_style',
        ]);

        $restaurant_ids = Subcategory::whereIn('id', [
            $restaurant_sub_1->id,
            $restaurant_sub_2->id,
            $restaurant_sub_3->id,
            $restaurant_sub_4->id,
            $restaurant_sub_5->id,
            $restaurant_sub_6->id,
            $restaurant_sub_7->id,
            $restaurant_sub_8->id,
            $restaurant_sub_9->id,
            $restaurant_sub_10->id,
            $restaurant_sub_11->id,
            $restaurant_sub_12->id,
            $restaurant_sub_13->id,
            $restaurant_sub_14->id,
            $restaurant_sub_15->id,
            $restaurant_sub_16->id,
            $restaurant_sub_17->id,
            $restaurant_sub_18->id,
            $restaurant_sub_19->id,
            $restaurant_sub_20->id,
            $restaurant_sub_21->id,
            $restaurant_sub_22->id,
            $restaurant_sub_23->id,
            $restaurant_sub_24->id,
            $restaurant_sub_25->id,
            $restaurant_sub_26->id,
            $restaurant_sub_27->id,
        ])->pluck('id');

        $hotel_ids = Subcategory::whereIn('id', [
            $restaurant_sub_1->id,
            $restaurant_sub_2->id,
            $restaurant_sub_3->id,
            $restaurant_sub_4->id,
            $restaurant_sub_5->id,
            $restaurant_sub_6->id,
            $hotel_sub_1->id,
            $restaurant_sub_8->id,
            $hotel_sub_2->id,
            $hotel_sub_3->id,
            $hotel_sub_4->id,
            $hotel_sub_5->id,
        ])->pluck('id');

        Category::create([
            'name' => 'RESTAURATION',
            'slug' => 'restauration',
            'children_id' => $restaurant_ids,
        ]);

        Category::create([
            'name' => 'HÔTELLERIE',
            'slug' => 'hotellerie',
            'children_id' => $hotel_ids,
        ]);
    }
}
