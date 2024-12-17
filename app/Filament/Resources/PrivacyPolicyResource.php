<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PrivacyPolicyResource\Pages;
use App\Models\PrivacyPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrivacyPolicyResource extends Resource
{
    protected static ?string $model = PrivacyPolicy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('effective_date')
                    ->label('Effective Date')
                    ->nullable(),

                Forms\Components\Textarea::make('introduction')
                    ->label('Introduction')
                    ->rows(4),

                Forms\Components\Repeater::make('sections')
                    ->label('Privacy Policy Sections')
                    ->schema([
                        Forms\Components\TextInput::make('heading')
                            ->label('Section Heading')
                            ->required(),

                        Forms\Components\Textarea::make('content')
                            ->label('Section Content')
                            ->rows(20)
                            ->required(),

                        Forms\Components\Repeater::make('subsections')
                            ->label('Subsections')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Subsection Title')
                                    ->nullable(),

                                Forms\Components\Textarea::make('content')
                                    ->label('Subsection Content')
                                    ->rows(20)
                                    ->nullable(),
                            ])
                            ->collapsible()
                            ->addable(true)
                            ->deletable(true),
                    ])
                    ->collapsible()
                    ->addable(true)
                    ->deletable(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('introduction')
                    ->label('Introduction')
                    ->limit(50),

                Tables\Columns\TextColumn::make('effective_date')
                    ->label('Effective Date')
                    ->date(),

                Tables\Columns\TextColumn::make('sections')
                    ->label('Sections')
                    ->getStateUsing(function (PrivacyPolicy $record) {
                        // Safely extract section headings
                        if (empty($record->sections)) {
                            return 'No sections';
                        }

                        $headings = collect($record->sections)
                            ->map(function ($section) {
                                $heading = $section['heading'] ?? 'Untitled';

                                // Check if subsections exist and extract their titles
                                $subsections = collect($section['subsections'] ?? [])
                                    ->pluck('title')
                                    ->filter()
                                    ->implode(', ');

                                return $subsections
                                    ? "{$heading} (Subsections: {$subsections})"
                                    : $heading;
                            })
                            ->implode(', ');

                        return $headings;
                    })
                    ->limit(300),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrivacyPolicies::route('/'),
            'create' => Pages\CreatePrivacyPolicy::route('/create'),
            'edit' => Pages\EditPrivacyPolicy::route('/{record}/edit'),
        ];
    }
}
