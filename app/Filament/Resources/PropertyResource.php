<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Properties';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('price_per_night')
                    ->label('Price per Night')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(1000),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('price_per_night')
                    ->label('Price per Night')
                    ->sortable()
                    ->money('usd'),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),
            ])
            ->searchable()  // Permet la recherche sur les colonnes "name" et "description"
            ->actions([
                EditAction::make(),
                // L'action de suppression
                Action::make('delete')
                    ->label('Delete')
                    ->button()
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->action(function (Property $record) {
                        $record->delete();  // Supprime la propriété
                        // Redirection après suppression pour actualiser la page
                        return redirect('/admin/properties');                    }),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->action(function () {
                        // Redirection après suppression de masse
                        return redirect('/admin/properties'); 
                    }),
            ])
            ->paginated([10, 25, 50, 100]);
    }
    
    public static function getRelations(): array
    {
        return [
            // Ajouter des relations ici si nécessaire
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
