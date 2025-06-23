<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentProfileResource\Pages;
use App\Models\StudentProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentProfileResource extends Resource
{
    protected static ?string $model = StudentProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Student Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\Textarea::make('about_me')
                            ->label('About Me')
                            ->required()
                            ->maxLength(1000),
                        Forms\Components\TextInput::make('full_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->length(16)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('birth_place')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('birth_date')
                            ->required(),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->maxLength(1000),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('Academic Information')
                    ->schema([
                        Forms\Components\Repeater::make('education_history')
                            ->schema([
                                Forms\Components\TextInput::make('institution')
                                    ->required(),
                                Forms\Components\TextInput::make('degree')
                                    ->required(),
                                Forms\Components\TextInput::make('field_of_study')
                                    ->required(),
                                Forms\Components\DatePicker::make('start_date')
                                    ->required(),
                                Forms\Components\DatePicker::make('end_date')
                                    ->required(),
                                Forms\Components\TextInput::make('gpa')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(4),
                            ])
                            ->columns(3),

                        Forms\Components\Repeater::make('work_experience')
                            ->schema([
                                Forms\Components\TextInput::make('company')
                                    ->required(),
                                Forms\Components\TextInput::make('position')
                                    ->required(),
                                Forms\Components\DatePicker::make('start_date')
                                    ->required(),
                                Forms\Components\DatePicker::make('end_date')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->required(),
                            ])
                            ->columns(2),

                        Forms\Components\Repeater::make('licenses_certifications')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('issuing_organization')
                                    ->required(),
                                Forms\Components\DatePicker::make('issue_date')
                                    ->required(),
                                Forms\Components\DatePicker::make('expiry_date')
                                    ->required(),
                                Forms\Components\TextInput::make('credential_id')
                                    ->required(),
                            ])
                            ->columns(2),

                        Forms\Components\Repeater::make('awards')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required(),
                                Forms\Components\TextInput::make('issuer')
                                    ->required(),
                                Forms\Components\DatePicker::make('date')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->required(),
                            ])
                            ->columns(2),

                        Forms\Components\TagsInput::make('skills')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Family Information')
                    ->schema([
                        Forms\Components\Repeater::make('family_data')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\Select::make('relationship')
                                    ->options([
                                        'father' => 'Father',
                                        'mother' => 'Mother',
                                        'sibling' => 'Sibling',
                                        'spouse' => 'Spouse',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('occupation')
                                    ->required(),
                                Forms\Components\TextInput::make('phone')
                                    ->tel(),
                            ])
                            ->columns(2),
                    ]),

                Forms\Components\Section::make('Documents')
                    ->schema([
                        Forms\Components\FileUpload::make('cv_path')
                            ->label('CV')
                            ->required()
                            ->directory('student-documents/cv'),
                        Forms\Components\FileUpload::make('transcript_path')
                            ->label('Academic Transcript')
                            ->required()
                            ->directory('student-documents/transcripts'),
                        Forms\Components\FileUpload::make('id_card_path')
                            ->label('ID Card')
                            ->required()
                            ->directory('student-documents/id-cards'),
                        Forms\Components\FileUpload::make('certificate_path')
                            ->label('Certificates')
                            ->required()
                            ->directory('student-documents/certificates'),
                        Forms\Components\FileUpload::make('cover_letter_path')
                            ->label('Cover Letter (Optional)')
                            ->directory('student-documents/cover-letters'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\ProgressColumn::make('completion_percentage')
                    ->label('Profile Completion')
                    ->color('success'),
                Tables\Columns\IconColumn::make('is_ready_for_internship')
                    ->label('Ready for Internship')
                    ->boolean(),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListStudentProfiles::route('/'),
            'create' => Pages\CreateStudentProfile::route('/create'),
            'edit' => Pages\EditStudentProfile::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
} 