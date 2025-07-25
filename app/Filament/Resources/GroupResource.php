<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Filament\Resources\GroupResource\RelationManagers;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Dvarilek\FilamentTableSelect\Components\Form\TableSelect;
use Filament\Tables\Columns\TextColumn;

class GroupResource extends Resource
{

    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                TableSelect::make('users')
                    ->relationship('users', 'name')
                    ->multiple()
                    ->requiresSelectionConfirmation()
                    ->selectionTable(function (Table $table) {
                        return $table
                            ->heading('Active Users')
                            ->columns([
                                TextColumn::make('name'),
                                TextColumn::make('email'),
                            ]);
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('users')
                    ->label('Usuarios')
                    ->getStateUsing(fn($record) => '<ul>' . $record->users->pluck('name')->map(fn($name) => "<li>{$name}</li>")->join('') . '</ul>')
                    ->html(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        if ($user) {
            return parent::getEloquentQuery()->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            });
        }
        return parent::getEloquentQuery();
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
