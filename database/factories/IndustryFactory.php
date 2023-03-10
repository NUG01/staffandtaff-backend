<?php

namespace Database\Factories;

use App\Models\Industry;
use App\Models\CategoryCriteria;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndustryFactory extends Factory
{
    protected $model = Industry::class;

    public function definition(): array
    {
        return [
            //
        ];
    }

    public function createPositions()
    {
        $restaurant_sub_1 = Position::create([
            'name' => 'Direction/Gérance',
            'slug' => 'direction_gerance',
        ]);

        $restaurant_sub_2 = Position::create([
            'name' => 'Manager',
            'slug' => 'manager',
        ]);

        $restaurant_sub_3 = Position::create([
            'name' => 'Barman/Barmaid/Mixologue',
            'slug' => 'barman_Barmaid_mixologue',
        ]);

        $restaurant_sub_4 = Position::create([
            'name' => 'Apprenti',
            'slug' => 'apprenti',
        ]);

        $restaurant_sub_5 = Position::create([
            'name' => 'Autre',
            'slug' => 'autre',
        ]);

        $restaurant_sub_6 = Position::create([
            'name' => 'Administratif',
            'slug' => 'administratif',
        ]);

        $restaurant_sub_7 = Position::create([
            'name' => "Hôte/Hôtesse d'accueil",
            'slug' => "hote_hotesse_daccueil",
        ]);
//
        $restaurant_sub_8 = Position::create([
            'name' => 'Voiturier',
            'slug' => 'voiturier',
        ]);

        $restaurant_sub_9 = Position::create([
            'name' => 'Chef de rang',
            'slug' => 'chef_de_rang',
        ]);

        $restaurant_sub_10 = Position::create([
            'name' => "Maître d’hôtel",
            'slug' => "maitre_d_hotel",
        ]);

        $restaurant_sub_11 = Position::create([
            'name' => 'Chef exécutif',
            'slug' => 'chef_executif',
        ]);

        $restaurant_sub_12 = Position::create([
            'name' => 'Chef de cuisine',
            'slug' => 'chef_de_cuisine',
        ]);

        $restaurant_sub_13 = Position::create([
            'name' => 'Second de cuisine',
            'slug' => 'second_de_cuisine',
        ]);

        $restaurant_sub_14 = Position::create([
            'name' => 'Chef de partie',
            'slug' => 'chef_de_partie',
        ]);

        $restaurant_sub_15 = Position::create([
            'name' => 'Commis',
            'slug' => 'commis',
        ]);

        $restaurant_sub_16 = Position::create([
            'name' => 'Cuisinier',
            'slug' => 'cuisinier',
        ]);

        $restaurant_sub_17 = Position::create([
            'name' => 'Aide cuisinier',
            'slug' => 'aide_cuisinier',
        ]);

        $restaurant_sub_18 = Position::create([
            'name' => 'Chef pâtissier',
            'slug' => 'chef_patissier',
        ]);

        $restaurant_sub_19 = Position::create([
            'name' => 'Second pâtissier',
            'slug' => 'second_patissier',
        ]);

        $restaurant_sub_20 = Position::create([
            'name' => 'Chef de partie pâtisserie',
            'slug' => 'chef_de_partie_patisserie',
        ]);

        $restaurant_sub_21 = Position::create([
            'name' => 'Commis pâtissier',
            'slug' => 'commis_patissier',
        ]);

        $restaurant_sub_22 = Position::create([
            'name' => 'Chef Sommelier',
            'slug' => 'chef_sommelier',
        ]);

        $restaurant_sub_23 = Position::create([
            'name' => 'Sommelier',
            'slug' => 'sommelier',
        ]);

        $restaurant_sub_24 = Position::create([
            'name' => 'Casserolier',
            'slug' => 'casserolier',
        ]);

        $restaurant_sub_25 = Position::create([
            'name' => 'Plongeur',
            'slug' => 'plongeur',
        ]);

        $restaurant_sub_26 = Position::create([
            'name' => 'Serveur',
            'slug' => 'serveur',
        ]);

        $restaurant_sub_27 = Position::create([
            'name' => 'Runner',
            'slug' => 'runner',
        ]);

        $hotel_sub_1 = Position::create([
            'name' => 'Réceptionniste',
            'slug' => 'receptionniste',
        ]);


        $hotel_sub_2 = Position::create([
            'name' => 'Conciergerie',
            'slug' => 'conciergerie',
        ]);

        $hotel_sub_3 = Position::create([
            'name' => 'Veilleur de nuit',
            'slug' => 'veilleur_de_nuit',
        ]);

        $hotel_sub_4 = Position::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
        ]);

        $hotel_sub_5 = Position::create([
            'name' => 'Femme de chambre/Agent de style',
            'slug' => 'femme_de_chambre_agent_de_style',
        ]);

        $restaurant_ids = Position::whereIn('id', [
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

        $hotel_ids = Position::whereIn('id', [
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

        Industry::create([
            'name' => 'RESTAURATION',
            'slug' => 'restauration',
            'children_id' => $restaurant_ids,
        ]);

        Industry::create([
            'name' => 'HÔTELLERIE',
            'slug' => 'hotellerie',
            'children_id' => $hotel_ids,
        ]);
    }
}
