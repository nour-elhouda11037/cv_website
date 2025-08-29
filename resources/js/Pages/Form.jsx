import React, { useState } from 'react'
import "../../css/style.css";
import "../../css/app.css";
import { useForm } from '@inertiajs/react'

export default function Form() {
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        school_name: [''],
        degree: [''],
        edu_start: [''],
        edu_end: [''],
        edu_desc: [''],

        company_name: [''],
        position: [''],
        exp_start: [''],
        exp_end: [''],
        exp_desc: [''],
        
        skill: [''],
        level: ['Beginner'],
    })
    const addField = (field) => {
        setData(field, [...data[field], ''])
    }

    const handleArrayChange = (field, index, value) => {
        const updated = [...data[field]]
        updated[index] = value
        setData(field, updated)
    }
    const handleSubmit = (e) => {
        e.preventDefault()
        post('/form') 
    }

    return (
        <form onSubmit={handleSubmit}>
            <h2>CV Title</h2>
            <input
                type="text"
                name="title"
                value={data.title}
                onChange={(e) => setData('title', e.target.value)}
                required
            />
            <h2>Education</h2>
            {data.school_name.map((_, i) => (
                <div key={i}>
                    <input
                        placeholder="School Name"
                        value={data.school_name[i]}
                        onChange={(e) => handleArrayChange('school_name', i, e.target.value)}
                        required
                    />
                    <input
                        placeholder="Degree"
                        value={data.degree[i]}
                        onChange={(e) => handleArrayChange('degree', i, e.target.value)}
                        required
                    />
                    <input
                        type="date"
                        value={data.edu_start[i]}
                        onChange={(e) => handleArrayChange('edu_start', i, e.target.value)}
                        required
                    />
                    <input
                        type="date"
                        value={data.edu_end[i]}
                        onChange={(e) => handleArrayChange('edu_end', i, e.target.value)}
                        required
                    />
                    <textarea
                        placeholder="Description"
                        value={data.edu_desc[i]}
                        onChange={(e) => handleArrayChange('edu_desc', i, e.target.value)}
                    />
                </div>
            ))}
            <button type="button" onClick={() => {

                addField('school_name')
                addField('degree')
                addField('edu_start')
                addField('edu_end')
                addField('edu_desc')
                }
            }>+ Add More Education</button>
            <h2>Experience</h2>
            {data.company_name.map((_, i) => (
                <div key={i}>
                    <input
                        placeholder="Company Name"
                        value={data.company_name[i]}
                        onChange={(e) => handleArrayChange('company_name', i, e.target.value)}
                        required
                    />
                    <input
                        placeholder="Position"
                        value={data.position[i]}
                        onChange={(e) => handleArrayChange('position', i, e.target.value)}
                        required
                    />
                    <input
                        type="date"
                        value={data.exp_start[i]}
                        onChange={(e) => handleArrayChange('exp_start', i, e.target.value)}
                        required
                    />
                    <input
                        type="date"
                        value={data.exp_end[i]}
                        onChange={(e) => handleArrayChange('exp_end', i, e.target.value)}
                        required
                    />
                    <textarea
                        placeholder="Description"
                        value={data.exp_desc[i]}
                        onChange={(e) => handleArrayChange('exp_desc', i, e.target.value)}
                    />
                </div>
            ))}
            <button type="button" onClick={() => {
                addField('company_name')
                addField('position')
                addField('exp_start')

                addField('exp_end')
                addField('exp_desc')
            }}>+ Add More Experience </button>
            <h2>Skills</h2>
            {data.skill.map((_, i) => (
                <div key={i}>
                    <input
                        placeholder="Skill"
                        value={data.skill[i]}
                        onChange={(e) => handleArrayChange('skill', i, e.target.value)}
                        required
                    />
                    <select
                        value={data.level[i]}
                        onChange={(e) => handleArrayChange('level', i, e.target.value)}
                    >
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate  </option>

                        <option value="Advanced"> Advanced</option>
                    </select>
                </div>
            ))}
            <button type="button" onClick={() => {
                addField('skill')
                addField('level')
            }}>+ Add More Skills</button>
            <br /><br />
            <button type="submit" disabled={processing}>Save CV</button>
        </form>
    )
}