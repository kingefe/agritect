import React from 'react'
import  FormInput  from './FormInput'
import { withFormValue } from './Form'
import GrowSystemInput from './GrowSystemInput'



export const CropInputDefault = withFormValue(({ index, model, infoIcon, form }) =>{

    return(
        <>
            <div class="col-md-4">
                <div class="form-group form-group">
                    <FormInput
                        className="form-control"
                        model={model}
                        name="crops.id"
                        formName={`cropId${index}`}
                        label={`Crop ${index}`}
                        field={{ type: 'choice' }}
                    />
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group form-group">
                    {/* <FormInput
                        className="form-control"
                        model={model}
                        infoIcon={infoIcon}
                        name="crops.grow system type"
                        formName={`growSystemType${index}`}
                        label={`Grow System ${index}`}
                        field={{ type: 'choice' }}
                    /> */}
                    <GrowSystemInput 
                        className="form-control"
                        model={model}
                        // name="crops.grow system type"
                        // formName={`growSystemType${index}`}
                        label={`Grow System ${index}`}
                        field={{ type: 'choice' }}
                        index={index}
                    />
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group form-group">
                    <div class="form-unit form-unit--right">
                        <FormInput
                            className="form-control"
                            model={model}
                            name="crops.system fraction"
                            formName={`cropPercentage${index}`}
                            label="Percentage of total"
                            field={{
                                type:        'decimal',
                                description: 'Fraction of bedspace allocated to crop',
                            }}
                        />
                        <div class="form-unit__type">%</div>
                    </div>
                </div>
            </div>

        </>
    )
})