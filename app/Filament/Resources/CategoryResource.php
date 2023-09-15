<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Loja';

    protected static ?string $modelLabel = 'Categoria';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->placeholder('Women Shoes, Baby Clothes clothes')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                        // if ($operation !== 'create') {
                                        //     return;
                                        // }

                                        $set('slug', Str::slug($state));
                                    }),

                                TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required(),
                                Select::make('parent_id')
                                    ->label('Parent')
                                    ->relationship('parent', 'name', fn (Builder $query) => $query->where('parent_id', null))
                                    ->searchable()
                                    ->placeholder('Select parent category')
                                    ->columnSpan('full'),
                                MarkdownEditor::make('description')
                                    ->columnSpan('full'),


                            ])->columns(2),

                    ])
                    ->columnSpan(['lg' => 2]),
                Group::make()
                    ->schema([
                        Section::make('Imagem')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('category-image')
                                    ->disableLabel(),
                            ]),
                        Section::make('Status')
                            ->schema([
                                Toggle::make('is_enabled')
                                    ->label('Habilitado')
                                    ->helperText('This category will be hidden from all sales channels.')
                                    ->default(true),
                            ]),
                        Section::make('Posição')
                            ->schema([
                                TextInput::make('position')
                                    ->label('Ordem')
                                    ->numeric(),
                            ]),

                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->description(function (Category $record) {
                        if ($record->parent_id) {
                            return 'na categoria ' . $record->parent_name;
                        }

                        return null;
                    }),
                TextColumn::make('count_sub_category')
                    ->label('Subcategoria'),
                TextColumn::make('parent.name')
                    ->label('Categoria Pai')
                    ->searchable(),
                IconColumn::make('is_enabled')
                    ->label('Visibility')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('position')
                    ->label('Ordem')
                    ->default(0)
            ])
            ->filters([
                Filter::make('Ativo')
                    ->query(fn (Builder $query): Builder => $query->where('is_enabled', true)),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
