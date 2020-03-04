async function api ({ command, model, mode, ...params }) {
    let modelo = mode ? `${model}_${mode}` : model
    const response = await fetch(`${ajaxurl}?action=model_viewer`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            ...params,
            cmd: command,
            model: modelo,
        }),
    })

    return await response.json()
}

export default api
