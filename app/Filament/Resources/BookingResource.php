<?php
namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(function () {
                        return \App\Models\User::all()->pluck('name', 'id');
                    })
                    ->required(),

                Forms\Components\Select::make('property_id')
                    ->label('Property')
                    ->options(function () {
                        return \App\Models\Property::all()->pluck('name', 'id');
                    })
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('End Date')
                    ->required(),

                // Afficher le champ status
                Forms\Components\TextInput::make('status')
                    ->label('Status')
                    ->disabled() // Le champ "status" est en lecture seule
                    ->default(fn (?Booking $record) => $record?->status ?? 'Pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('property.name')
                    ->label('Property')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->sortable(),

                // Afficher le champ status dans le tableau
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([ 
                // Ajouter des filtres si nécessaire
            ])
            ->actions([
                EditAction::make(),
                
                // Ajouter l'action d'annulation sous forme de bouton
                Action::make('cancel')
                    ->label('Cancel Reservation')
                    ->button()  // Affiche le bouton
                    ->color('danger')  // Couleur du bouton (rouge pour danger)
                    ->icon('heroicon-o-x-circle')  // Icône du bouton
                    ->action(function (Booking $record) {
                        $record->status = 'cancelled';  // Mettre à jour le statut à 'cancelled'
                        $record->save();

                        // Affiche le message de succès
                        \Filament\Notifications\Notification::make()
                            ->title('Reservation Canceled')
                            ->success()
                            ->send();

                        // Rafraîchissement complet de la page
                        return redirect('/admin/bookings');
                    })
                    ->disabled(fn (Booking $record) => $record->status === 'cancelled'),  // Désactive le bouton si annulé
               
                // Ajouter l'action de validation sous forme de bouton
                Action::make('confirm')
                    ->label('Confirm Reservation')
                    ->button()  // Affiche le bouton
                    ->color('success')  // Couleur du bouton (vert pour success)
                    ->icon('heroicon-o-check-circle')  // Icône du bouton
                    ->action(function (Booking $record) {
                        $record->status = 'confirmed';  // Mettre à jour le statut à 'confirmed'
                        $record->save();

                        // Affiche le message de succès
                        \Filament\Notifications\Notification::make()
                            ->title('Reservation Confirmed')
                            ->success()
                            ->send();

                        // Rafraîchissement complet de la page
                        return redirect('/admin/bookings');
                    })
                    ->disabled(fn (Booking $record) => $record->status === 'confirmed' ),  // Désactive le bouton si confirmé ou annulé
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
